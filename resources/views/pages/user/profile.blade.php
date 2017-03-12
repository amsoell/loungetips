@extends('app')

@section('content')

<div class="row">
	<div class="col-xs-12 col-md-10 col-md-offset-1">

		<div class="row">
			@if ($user->posts->count() > 0)
			<div class="col-xs-12 col-sm-5 text-right">
				<img src="//www.gravatar.com/avatar/{{ md5($user->email) }}?d=retro&size=275" />
			</div>
			<div class="col-xs-12 col-sm-7 text-left">
				<h3 class="no-margin">Codename: &quot;{{ $user->name }}&quot;</h3>
				<p><strong>Rank:</strong>
				@php
				$sharedTips = $user->tips->count();

				if ($sharedTips >= 1025) {
					echo 'Wowie Howie!';
				} elseif ($sharedTips >= 500) {
					echo 'Lounge Tip God';
				} elseif ($sharedTips >= 100) {
					echo 'Lounge Tip Superstar';
				} elseif ($sharedTips >= 50) {
					echo 'Lounge Tip Rockstar';
				} elseif ($sharedTips >= 10) {
					echo 'Tip Supplier';
				} elseif ($sharedTips >= 1) {
					echo 'Tip Contributor';
				} else {
					echo 'Lounge Tip Leech';
				}
				@endphp
				</p>
				<h3>Vitals</h3>
				<p>
					<strong>Joined:</strong> {{ $user->created_at->format('F j, Y') }}<br />
					<strong>Tips shared:</strong> {{ number_format($sharedTips, 0, '.', ',') }}<br />
					<strong>Posts made:</strong> {{ number_format($user->posts->count(), 0, '.', ',') }}<br />
					<strong>Threads started:</strong> {{ number_format($user->threads->count(), 0, '.', ',') }}
				</p>
				<h3>Activity</h3>
				<p>
				@if ($user->posts->count() > 0)
					<strong>First post:</strong> <a href="{{ Forum::route('post.show', $user->posts()->orderBy('created_at', 'desc')->first()) }}">{{ $user->posts()->orderBy('created_at', 'desc')->first()->created_at->format('F j, Y') }}</a><br />
					<strong>Most recent post:</strong> <a href="{{ Forum::route('post.show', $user->posts()->orderBy('created_at', 'asc')->first()) }}">{{ $user->posts()->orderBy('created_at', 'asc')->first()->created_at->format('F j, Y') }}</a><br />
				@endif
				@if ($user->tips->count() == 1)
					<strong>Lone tip contribution:</strong> {{ $user->tips->first()->created_at->format('F j, Y') }} ("{{ $user->tips->first()->tip }}")<br />
				@elseif ($user->tips->count() > 1)
					<strong>First tip contribution:</strong> {{ $user->tips()->orderBy('created_at', 'asc')->first()->created_at->format('F j, Y') }} ("{{ strtolower($user->tips()->orderBy('created_at', 'asc')->first()->tip) }}")<br />
					<strong>Most recent tip:</strong> {{ $user->tips()->orderBy('created_at', 'desc')->first()->created_at->format('F j, Y') }} ("{{ strtolower($user->tips()->orderBy('created_at', 'desc')->first()->tip) }}")<br />
				@endif
				</p>

			</div>
			@else
			<div class="text-center">
				<img src="/images/anonymous.gif" alt="" />
				<p>Just another anonymous tipster.</p>
			</div>
			@endif
		</div>
	</div>
</div>

@endsection
