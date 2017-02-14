<?php

namespace App;

use Laratrust\LaratrustGroup;

class Group extends LaratrustGroup
{
    /**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName()
	{
	    return 'name';
	}
}
