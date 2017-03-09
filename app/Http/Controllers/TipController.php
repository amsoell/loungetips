<?php

namespace App\Http\Controllers;

use App\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipController extends Controller {

	public function store(Request $request) {
		$tip              = new Tip();
		$tip->name        = $request->get('tip');
		$tip->description = $request->get('description');
		if (Auth::user()) {
			$tip->user()->associate(Auth::user());
			$tip->remoteaddr = $request->ip();
			$tip->useragent  = $request->header('User-Agent');
		}
		$tip->save();

		return $this->pageHome($request);
	}

	public function pageHome(Request $request) {
		$tips = Tip::today()->orderBy('created_at', 'desc')->get();
		return view('pages.home.index', compact('tips'));
	}
}
