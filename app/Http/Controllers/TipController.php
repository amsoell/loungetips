<?php

namespace App\Http\Controllers;

use App\Tip;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class TipController extends Controller {

	public function store(Request $request) {
		// Quick and dirty validation
		if (Tip::where('remoteaddr', $request->ip())->where('description', $request->get('description'))->exists()) {
			$request->session()->flash('status', [
				'type' => 'alert',
				'body' => 'You have already submitted a tip for this period.'
			]);
		} elseif (! ($request->has('tip') && $request->has('description'))) {
			$request->session()->flash('status', [
				'type' => 'danger',
				'body' => 'Please enter a tip and associated time period.'
			]);
		} elseif (preg_match('/^[A-Za-z0-9]+$/i', $request->get('tip'))===false) {
			$request->session()->flash('status', [
				'type' => 'danger',
				'body' => 'Tips can only include letters and numbers. No spaces or punctuation, please.'
			]);
		} else {

			$tip              = new Tip();
			$tip->name        = $request->get('tip');
			$tip->description = $request->get('description');
			$tip->remoteaddr = $request->ip();
			$tip->useragent  = $request->header('User-Agent');
			if (Auth::user()) $tip->user()->associate(Auth::user());

			$tip->save();

			$request->session()->flash('status', [
				'type' => 'success',
				'body' => 'Thank you for sharing!'
			]);
		}

		return redirect()->route('home');
	}

	public function report(Request $request, Tip $tip) {
		// Quick and dirty validation
		if ($tip->reports()->where('remoteaddr', $request->ip())->exists()) {
			$request->session()->flash('status', [
				'type' => 'danger',
				'body' => 'You have already reported on this tip.'
			]);
		} else {

			$report = new Report();
			$report->tip()->associate($tip);
			$report->report     = filter_var($request->get('report'), FILTER_VALIDATE_BOOLEAN);
			$report->remoteaddr = $request->ip();
			$report->useragent  = $request->header('User-Agent');
			if (Auth::user()) $report->user()->associate(Auth::user());

			$report->save();

			$request->session()->flash('status', [
				'type' => 'success',
				'body' => 'Thank you for reporting!'
			]);
		}

		return redirect()->route('home');
	}

	public function pageHome(Request $request) {
		$tips = Tip::today()->orderBy('created_at', 'desc')->get();
		return view('pages.home.index', compact('tips'));
	}

	public function pageTop() {
		$topTips30 = Tip::select(DB::raw("name, COUNT(*) as count"))->groupBy('name')->orderBy('count', 'desc')->where('created_at', '>=', Carbon::now()->subDays(30))->limit(10)->get();
		$topTips = Tip::select(DB::raw("name, COUNT(*) as count"))->groupBy('name')->orderBy('count', 'desc')->limit(10)->get();

		return view('pages.top.index', compact('topTips30', 'topTips'));
	}
}
