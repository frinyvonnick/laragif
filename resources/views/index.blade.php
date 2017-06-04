@extends('layouts.app')

@section('content')
	<application :gifs="{{json_encode($gifs)}}" />
@endsection
