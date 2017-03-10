@extends('app')

@section('content')

<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		<p>If you're a frequent CD101 listener and collect lounge points, you've probably noticed that CD101 recycles their lounge tips quite often. We thought it would be fun to show the top tips since we've been reporing them. This doesn't really serve any practical purpose, just something that seemed fun and interesting.</p>

		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
				<h3>Past 30 Days</h3>
				<ol>
					@foreach ($topTips30 as $tip)
					<li>{{ ucfirst(strtolower($tip->tip)) }} ({{ $tip->count }}x)</li>
					@endforeach
				</ol>

				<h3>All-Time Top Tips</h3>
				<ol>
					@foreach ($topTips as $tip)
					<li>{{ ucfirst(strtolower($tip->tip)) }} ({{ $tip->count }}x)</li>
					@endforeach
				</ol>
			</div>
		</div>
	</div>
</div>

@endsection
