<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		@foreach ($tips as $tip)
		<div class="row well tip">
			@includeWhen($tip->reports->count()==0, 'pages.home.partial.thumbsup')
			<div class="col-xs-{{ $tip->reports->count()==0?'8':'12' }} text-center">
				<div class="text">
					Your <b>{{ $tip->description }}</b> tip is <b class="thetip">{{ $tip->name }}</b>
				</div>
				<div class="detail">
					Shared by {{ $tip->user?$tip->user->name:'Guest' }} &middot; {{ $tip->created_at->format('g:i a') }} &middot;
					<span title="0 Good 0 Bad">
						Confidence: <span class="totalscore" rel="0">Unknown</span>
					</span>
				</div>
			</div>
			@includeWhen($tip->reports->count()==0, 'pages.home.partial.thumbsdown')
		</div>
		@endforeach
	</div>
</div>
