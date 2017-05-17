@extends('layouts.app')

@section('content')
		<application
			:initial-endpoint="{{ json_encode($endpoint) }}"
			:initial-gifs="{{ json_encode($gifs) }}"
		>
		</application>
@endsection
