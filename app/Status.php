<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
	use SoftDeletes;
	
    public function transactions() {
    	return $this->hasMany('App\Transaction');
    }
}
