<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		@foreach ($tips as $index => $tip)
		@includeWhen($tips->count()==1 || $tips->count()==$index+1 || $index+1==2, 'partial.ads.tip')
		<div class="row well tip tip-{{ $index }}">
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
		<div class="row well">
			<div class="col-xs-12 text-center">
				<button type="button" class="btn btn-link btn-lg" data-toggle="modal" data-target="#loungeModal">
					Go to the Lounge
				</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="loungeModal" tabindex="-1" role="dialog" aria-labelledby="loungeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="height: 700px">
			<div class="modal-header">
				<h4 class="modal-title">The Lounge</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						@include('partial.ads.lounge')
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<iframe src="http://els.fimc.net/wwcd/els/elsLoginFrm.asp" frameborder="0" scrolling="yes" style="width: 100%; height: 550px"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
