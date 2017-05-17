@extends('layouts.app')

@section('content')
		<application
			:initial-endpoint="{{ json_encode($endpoint) }}"
			:initial-gifs="{{ json_encode($gifs) }}"
			:authenticated-user="{{ Auth::guest() ? '{}' : json_encode(Auth::user()) }}"
		>
		</application>
@endsection
