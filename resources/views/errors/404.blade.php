@extends('app')

@section('content')

<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
		<h3>We can't find what you were looking for.</h3>
		<p><img src="/images/404.gif" alt="" /></p>
		<p>Try visiting the <a href="{{ route('home') }}">home page</a> and go from there.</p>
	</div>
</div>

@endsection
