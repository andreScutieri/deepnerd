<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Friend extends Model
{
    /**
     * @var string
     */
    public $table = 'friendships';

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function sender(): MorphTo
    {
    	return $this->morphTo('sender');
    }

    public function recipient(): MorphTo
    {
    	return $this->morphTo('recipient');
    }
}
