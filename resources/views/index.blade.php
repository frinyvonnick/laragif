@extends('layouts.app')

@section('content')
	<div id="app">
		<application
			:gifs="{{ json_encode($gifs) }}"
			:authenticated-user="{{ Auth::guest() ? '{}' : json_encode(Auth::user()) }}"
		></application>
	</div>
@endsection
