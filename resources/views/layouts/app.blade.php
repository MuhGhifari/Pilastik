<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@yield('styles')
	<title></title>
</head>

<body>
	@yield('content')
	@yield('scripts')
</body>