<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model {
	public function user() {
		return $this->belongsTo(User::class);
	}

	public function reports() {
		return $this->hasMany(Report::class);
	}

	public function scopeToday($query) {
		return $query->where('created_at', '>=', Carbon::today());
	}

	public function getConfidenceAttribute() {
		return $this->reports->count() - ($this->reports->count() - $this->reports->sum('report'));
	}
}
