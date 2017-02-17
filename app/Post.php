<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasComments;

class Post extends Model
{
	use HasComments;
	
    /**
     * @return BelongsTo
     */


    public function hub() {

    	return $this->belongsTo('App\Hub');
    
    }

    public function user() {

    	return $this->belongsTo('App\User');
    }
}
