<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		@foreach ($tips as $tip)
		<div class="row well tip">
			@includeWhen($tip->reports->count()==0, 'pages.home.partial.thumbsup')
			<div class="col-xs-{{ $tip->reports->count()==0?'8':'12' }} text-center">
				<div class="text">
					Your <b>{{ $tip->description }}</b> tip is <b class="thetip">{{ $tip->tip }}</b>
				</div>
				<div class="detail">
					Shared by {{ $tip->user?$tip->user->name:'Guest' }} &middot; {{ $tip->created_at->format('g:i a') }} &middot;
					<span title="{{ $tip->reports->where('report', 1)->count() }} Good {{ $tip->reports->where('report', 0)->count() }} Bad">
						Confidence: <span class="totalscore" rel="0">{{ $tip->reports->sum('report') - ($tip->reports->count() - $tip->reports->sum('report')) }}</span>
					</span>
				</div>
			</div>
			@includeWhen($tip->reports->count()==0, 'pages.home.partial.thumbsdown')
		</div>
		@endforeach
	</div>
</div>
