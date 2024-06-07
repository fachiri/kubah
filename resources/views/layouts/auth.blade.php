<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('header') - {{ config('app.name') }}</title>
		@laravelPWA
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
		@vite(['resources/css/app.css', 'resources/js/app.js'])
		<style>
			* {
				font-family: "Nunito Sans", sans-serif;
			}

			.auth-bg {
				background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
			}

			.color-gradient {
				background: linear-gradient(to right, #f63e37, #827adf);
				-webkit-background-clip: text;
				-webkit-text-fill-color: transparent;
				background-clip: text;
			}
		</style>
	</head>

	<body class="auth-bg">
		<header class="p-5">
			<h1 class="text-center text-2xl font-bold color-gradient">KuBah</h1>
		</header>
		<main class="px-5">
			<div class="mb-5">
				<img src="{{ asset('images/illustration/society.png') }}" alt="Society Illustration">
			</div>
			<h2 class="mb-5 text-center font-medium">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi eaque nisi eum!</h2>
			@yield('content')
		</main>
		<footer class="p-6">
			<p class="text-center text-sm">&copy; 2024 <span class="font-bold">KuBah</span>. All rights reserved.</p>
		</footer>
	</body>

</html>
