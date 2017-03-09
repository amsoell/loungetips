<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		@foreach ($tips as $tip)
		<div class="row well tip">
			<div class="col-xs-2">
				<img class="hover thumbs up" rel="/images/thumbsuphover.jpg" src="/images/thumbsup.jpg" />
			</div>
			<div class="col-xs-8 text-center">
				<div class="text">
					Your <b>3am</b> tip is <b class="thetip">test</b>
				</div>
				<div class="detail">
					Shared by Guest &middot; 3:19 am &middot;
					<span title="0 Good 0 Bad">
						Confidence: <span class="totalscore" rel="0">Unknown</span>
					</span>
				</div>
			</div>
			<div class="col-xs-2 text-right">
				<img class="hover thumbs down" rel="/images/thumbsdownhover.jpg" src="/images/thumbsdown.jpg" />
			</div>
		</div>
		@endforeach
	</div>
</div>
