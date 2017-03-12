@extends('app')

@section('content')

<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
		<h2>Ruh roh...</h2 class="text-center">
		<p><img src="/images/500.gif" alt="" /></p>
		<p>Something happened on our end. Try going <a href="{{ URL::previous() }}">back</a> and try again.</p>
		<p>If the problem persists, <a href="mailto:inquiries@loungetips.com">reach out to us</a> and let us know.</p>
	</div>
</div>

@endsection
