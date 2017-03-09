<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model {
	public function user() {
		return $this->belongsTo(User::class);
	}

	public function scopeToday($query) {
		return $query->where('created_at', '>=', Carbon::today());
	}
}
