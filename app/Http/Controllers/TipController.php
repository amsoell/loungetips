<?php

namespace App\Http\Controllers;

use App\Tip;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipController extends Controller {

	public function store(Request $request) {
		$tip              = new Tip();
		$tip->name        = $request->get('tip');
		$tip->description = $request->get('description');
		$tip->remoteaddr = $request->ip();
		$tip->useragent  = $request->header('User-Agent');
		if (Auth::user()) $tip->user()->associate(Auth::user());

		$tip->save();

		return redirect()->route('home');
	}

	public function report(Request $request, Tip $tip) {
		$report = new Report();
		$report->tip()->associate($tip);
		$report->report     = filter_var($request->get('report'), FILTER_VALIDATE_BOOLEAN);
		$report->remoteaddr = $request->ip();
		$report->useragent  = $request->header('User-Agent');
		if (Auth::user()) $report->user()->associate(Auth::user());

		$report->save();

		return redirect()->route('home');
	}

	public function pageHome(Request $request) {
		$tips = Tip::today()->orderBy('created_at', 'desc')->get();
		return view('pages.home.index', compact('tips'));
	}
}
