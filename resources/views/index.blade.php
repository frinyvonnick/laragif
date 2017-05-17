@extends('layouts.app')

@section('content')
	@foreach ($gifs as $gif)
		<img src="{{$gif->url}}" />
	@endforeach
@endsection
