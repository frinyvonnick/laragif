<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laragif</title>
</head>
<body>
	@foreach ($gifs as $gif)
		<img src="{{ $gif->url }}" />
	@endforeach
</body>
</html>
