<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasFriends
{

	private $pending = 0;

	private $accepted = 1;

	private $denied = 2;

	private $blocked = 3;

	public function friends(): MorphMany
	{
		return $this->morphMany(Friend::class, 'sender');
	}

	public function befriend(Model $recipient): bool
	{
		if ($this->isFriendsWith($recipient)) {
			return true;
		}

		$friendship = (new Friend())->forceFill([
			'recipient_id' => $recipient->id,
			'recipient_type' => get_class($recipient),
			'status' => $this->pending,
		]);

		return (bool) $this->friends()->save($friendship);
	}

	public function unfriend(Model $recipient): bool
	{
		if (!this->isFriendsWith($recipient)) {
			return;
		}

		return (bool) $this->findFriendship($recipient)->delete();
	}

	public function isFriendsWith(Model $recipient, $status = null): bool
	{
		$exists = $this->findFriendship($recipient);

		if (!empty($status)) {
			$exists = $exists->where('status', $status);
		}

		return (bool) $exists->count();
	}

	public function acceptFriendRequest(Model $recipient): bool
	{
		if (!$this->isFriendRequest(Model $recipient)) {
			return;
		}

		return (bool) $this->findFriendship($recipient)->update([
			'status' => $this->accepted,
		]);
	}

	public function denyFriendRequest(Model $recipient): bool
	{
		if (!this->isFriendsWith($recipient)) {
			return;
		}

		return (bool) $this->findFriendship($recipient)->update([
			'status' => $this->denied,
		]);
	}

	public function blockFriendRequest(Model $recipient): bool
	{
		if (!$this->isFriendsWith($recipient)) {
			return;
		}

		return (bool) $this->findFriendship($recipient)->update([
			'status' => $this->blocked,
		]);
	}

	public function unblockFriendRequest(Model $recipient): bool
	{
		if (!$this->isFriendsWith($recipient)) {
			return;
		}

		return (bool) $this->findFriendship($recipient)->update([
			'status' => $this->pending,
		]);
	}

	public function getFriendship($recipient): Friend
	{
		return $this->findFriendship($recipient)->first();
	}

	public function getAllFriendships($limit = null, $offset = null): Collection
	{
		return $this->findFriendshipsByStatus(null, $limit, $offset);
	}

	public function getPendingFriendships($limit = null, $offset = null): Collection
	{
		return $this->findFriendshipsByStatus($this->pending, $limit, $offset);
	}

	public function getAcceptedFriendships($limit = null, $offset = null): Collection
	{
		return $this->findFriendshipsByStatus($this->accepted, $limit, $offset);
	}


	public function getDeniedFriendships($limit = null, $offset = null): Collection
	{
		return $this->findFriendshipsByStatus($this->denied, $limit, $offset);
	}


	public function getBlockedFriendships($limit = null, $offset = null): Collection
	{
		return $this->findFriendshipsByStatus($this->blocked, $limit, $offset);
	}

	public function hasBlocked(Model $recipient): bool
	{
		return $this->getFriendship($recipient)->status === $this->blocked;
	}

	public function isBlockedBy(Model $recipient): bool
	{
		$friendship = Friend::where(function ($query) use ($recipient) {
			$query->where('sender_id', $this->id);
			$query->where('sender_type', get_class($this));

			$query->where('recipient_id', $recipient->id);
			$query->where('recipient_type', get_class($recipient));
		})->first();

		return $friendship ? ($friendship->status === $this->blocked) : false;
	}

	public function getFriendRequests(): Collection
	{
		return Friend::where(function ($query) {
			$query->where('recipient_id', $this->id);
			$query->where('recipient_type', get_class($this));
			$query->where('status', $this->pending);
		})->get();
	}

	private function findFriendship(Model $recipient): Collection
	{
		return Friend::where(function($query) use ($recipient) {
			$query->where('sender_id', $this->id);
			$query->where('sender_type', get_class($this));

			$query->where('recipient_id', $recipient->id);
			$query->where('recipient_type', get_class($recipient));
		})->orWhere(function $query use ($recipient) {
			$query->where('sender_id', $recipient->id);
			$query->where('sender_type', get_class($recipient));

			$query->where('recipient_id', $this->id);
			$query->where('recipient_type', get_class($this));
		});
	}

	private function findFriendshipsByStatus($status, $limit, $offset): array
	{
		$friendships = [];

		$query = Friend::where(function ($query) use ($status) {
			$query->where('sender_id', $this->id);
            $query->where('sender_type', get_class($this));
            if (!empty($status)) {
                $query->where('status', $status);
            }
        })->orWhere(function ($query) use ($status) {
            $query->where('recipient_id', $this->id);
            $query->where('recipient_type', get_class($this));
            if (!empty($status)) {
                $query->where('status', $status);
            }
		});

		if (!empty($limit)) {
			$query->take($limit);
		}

		if (!empty($offset)) {
			$query->skip($offset);
		}

		foreach ($query->get() as $friendship) {
			$friendships[] = $this->getFriendship($this->find(
				($friendship->sender_id == $this->id) ? $friendship->recipient_id : $friendship->sender_id
			));
		}

		return $friendships;
	}
}