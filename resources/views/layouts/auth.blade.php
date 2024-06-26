<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') - {{ config('app.name') }}</title>
		@include('includes.head')
		<style>
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

	<body class="auth-bg max-w-md min-h-screen mx-auto">
		<header class="p-5">
			<h1 class="text-center text-2xl font-bold color-gradient">KuBah</h1>
		</header>
		<main class="px-5">
			<div class="mb-5">
				<img src="{{ asset('images/illustration/society.png') }}" alt="Society Illustration">
			</div>
			<h2 class="mb-5 text-center font-medium">Segera Laporkan Jika Mengalami Atau Menjadi Saksi Adanya Kekerasan Dalam Rumah Tangga dan Kekerasan Seksual!</h2>
			@yield('content')
		</main>
		@include('includes.footer')
		@stack('scripts')
	</body>

</html>
