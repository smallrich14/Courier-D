<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use UseDeletes;

    public function users() 
    {
    	return $this->hasMany('App\User');
    }
}
