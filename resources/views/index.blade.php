@extends('layouts.app')

@section('content')
		<application
			:initial-gifs="{{ json_encode($gifs) }}"
		>
		</application>
@endsection
