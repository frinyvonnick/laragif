<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<title>Laragif</title>

	<script>
			window.Laravel = {!! json_encode([
					'csrfToken' => csrf_token(),
			]) !!};
	</script>
</head>
<body>
	<div id="app">
		<application :gifs="{{json_encode($gifs)}}"></application>
	</div>
	<script src="/js/app.js"></script>
</body>
</html>
