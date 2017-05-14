@extends('layouts.app')

@section('content')
		<application
			:endpoint="{{ json_encode($endpoint) }}"
			:gifs="{{ json_encode($gifs) }}"
			:authenticated-user="{{ Auth::guest() ? '{}' : json_encode(Auth::user()) }}"
		>
		</application>
@endsection
