<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
	use SoftDeletes;
	
     public function status() {
    	return $this->belongsTo('App\Status');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function item() {
        return $this->belongsTo('App\Item');
    }

}
