<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model{
	public function tip() {
		return $this->belongsTo(Tip::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}
