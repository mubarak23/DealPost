<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
	public function post(){
		return $this->belongsTo(User::class);
	}

	public function video(){
		return $this->belongsTo(User::class);
	}
}
