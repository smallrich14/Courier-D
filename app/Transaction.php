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

    public function items() {
        return $this->belongsToMany('App\Item', 'transaction_items')
            ->withPivot('borrow_date','return_date')
            ->withTimestamps();
    }

}
