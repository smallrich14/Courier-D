<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
     public function status() {
    	return $this->belongsTo('App\Status');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
