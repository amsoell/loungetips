@extends('app')

@section('content')

<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2">
		<h2 class="text-center">Got a tip? Share it!</h2 class="text-center">
		@include('pages.home.partial.share')
		@include('pages.home.partial.tip')
	</div>
</div>

@endsection
