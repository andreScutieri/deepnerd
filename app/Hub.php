<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    protected $fillable = ['name, display_name, description, visible, nsfw, dice, official'];

    public function users() {
    	return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function posts() {
    	return $this->hasMany('App\Post');
    }
}