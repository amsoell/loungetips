<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipController extends Controller {
	public function pageHome(Request $request) {
		$tips = [];
		return view('pages.home.index', compact('tips'));
	}
}
