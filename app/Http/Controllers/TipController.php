<?php

namespace App\Http\Controllers;

use App\Tip;
use App\Report;
use Riari\Forum\Models\Thread;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\TipVerified;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;

class TipController extends Controller {
	use Notifiable;

	public function store(Request $request) {
		// Quick and dirty validation
		if (Tip::where('remoteaddr', $request->ip())->where('description', $request->get('description'))->exists()) {
			$status =[
				'type' => 'danger',
				'body' => 'You have already submitted a tip for this period.'
			];
		} elseif (! ($request->has('tip') && $request->has('description'))) {
			$status = [
				'type' => 'danger',
				'body' => 'Please enter a tip and associated time period.'
			];
		} elseif (preg_match('/^[A-Za-z0-9]+$/i', $request->get('tip'))===false) {
			$status = [
				'type' => 'danger',
				'body' => 'Tips can only include letters and numbers. No spaces or punctuation, please.'
			];
		} else {

			$tip              = new Tip();
			$tip->tip         = $request->get('tip');
			$tip->description = $request->get('description');
			$tip->remoteaddr  = $request->ip();
			$tip->useragent   = $request->header('User-Agent');
			if (Auth::user()) $tip->user()->associate(Auth::user());

			$tip->save();

			Cache::add('totalTips', Tip::count(), 60);

			$status = [
				'type' => 'success',
				'body' => 'Thank you for sharing!'
			];
		}

		return redirect()->back()->with(compact('status'));
	}

	public function report(Request $request, Tip $tip) {
		// Quick and dirty validation
		if ($tip->reports()->where('remoteaddr', $request->ip())->exists()) {
			$status = [
				'type' => 'danger',
				'body' => 'You have already reported on this tip.'
			];
		} else {

			$report = new Report();
			$report->tip()->associate($tip);
			$report->report     = filter_var($request->get('report'), FILTER_VALIDATE_BOOLEAN);
			$report->remoteaddr = $request->ip();
			$report->useragent  = $request->header('User-Agent');
			if (Auth::user()) $report->user()->associate(Auth::user());

			$report->save();

			$status =[
				'type' => 'success',
				'body' => 'Thank you for reporting!'
			];

			if ((Tip::today()->where('tweeted', true)->count() == 0) &&
				($tip->confidence >=5 )) {
				// First verified tip of the day. Let's tweet about it
				$this->notify(new TipVerified($tip));
				$tip->tweeted = true;
				$tip->update();
			}
		}

		return redirect()->back()->with(compact('status'));
	}

	public function pageHome(Request $request) {
		// Update master tip count
		Cache::add('totalTips', Tip::count(), 60);

		// Update topic overview
		Cache::add('recentThreads', Thread::orderBy('updated_at', 'desc')->limit(5)->get(), 60);

		// Get today's tips
		$tips = Tip::with('reports')->today()->orderBy('created_at', 'desc')->get();

		return view('pages.home.index', compact('tips', 'request'));
	}

	public function pageTop() {
		$topTips30 = Tip::select(DB::raw("tip, COUNT(*) as count"))->groupBy('tip')->orderBy('count', 'desc')->where('created_at', '>=', Carbon::now()->subDays(30))->limit(10)->get();
		$topTips = Tip::select(DB::raw("tip, COUNT(*) as count"))->groupBy('tip')->orderBy('count', 'desc')->limit(10)->get();

		return view('pages.top.index', compact('topTips30', 'topTips'));
	}
}
