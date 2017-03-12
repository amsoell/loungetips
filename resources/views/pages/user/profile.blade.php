@extends('app')

@section('content')

<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
		<h2 class="text-center">{{ $user->name }}</h2 class="text-center">
		<p><img src="//www.gravatar.com/avatar/{{ md5($user->email) }}?d=retro&size=300" /></p>
		<p>Tips shared: {{ number_format($user->tips->count(), 0, '.', ',') }}</p>

	</div>
</div>

@endsection
