@extends('layouts.app')

@section('content')
	<div id="app">
		<search-bar :initial-search="{{ isset($search) ? json_encode($search) : "''" }}"></search-bar>
		<application
			:endpoint="{{ json_encode($endpoint) }}"
			:gifs="{{ json_encode($gifs) }}"
			:authenticated-user="{{ Auth::guest() ? '{}' : json_encode(Auth::user()) }}"
		>
		</application>
	</div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
