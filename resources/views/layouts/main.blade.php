<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') - {{ config('app.name') }}</title>
		@include('includes.head')
		<style>
			.main-bg {
				background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
			}

			.color-gradient {
				background: linear-gradient(to right, #f63e37, #827adf);
				-webkit-background-clip: text;
				-webkit-text-fill-color: transparent;
				background-clip: text;
			}

			.truncate-multiline {
				display: -webkit-box;
				-webkit-box-orient: vertical;
				-webkit-line-clamp: 3;
				overflow: hidden;
			}
		</style>
	</head>

	<body class="bg-slate-300">
		<div class="mx-auto min-h-screen max-w-md bg-white">
			<header>
				@yield('header')
			</header>
			<nav class="fixed bottom-0 left-0 flex w-full justify-center">
				<div class="h-16 w-full max-w-md border-t border-gray-200 bg-white dark:border-gray-600 dark:bg-gray-700">
					<div class="mx-auto grid h-full max-w-lg grid-cols-4 font-medium">
						<a href="{{ route('home.index') }}" class="group inline-flex flex-col items-center justify-center border-x border-gray-200 px-5 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
							<svg class="mb-2 h-5 w-5 {{ request()->is('home') ? 'text-purple-700' : 'text-gray-500' }} dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
								<path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
							</svg>
							<span class="text-sm {{ request()->is('home') ? 'text-purple-700' : 'text-gray-500' }} dark:text-gray-400 dark:group-hover:text-purple-500">
								Beranda
							</span>
						</a>
						<a href="{{ route('chat.index') }}" class="group inline-flex flex-col items-center justify-center border-e border-gray-200 px-5 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
							<svg class="mb-2 h-5 w-5 {{ request()->is('chat') ? 'text-purple-700' : 'text-gray-500' }} dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd"/>
								<path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd"/>
							</svg>
							<span class="text-sm {{ request()->is('chat') ? 'text-purple-700' : 'text-gray-500' }} dark:text-gray-400 dark:group-hover:text-purple-500">
								Obrolan
							</span>
						</a>
						<a href="{{ route('complaints.index') }}" class="group inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800">
							<svg class="mb-2 h-5 w-5 {{ request()->is('complaints') ? 'text-purple-700' : 'text-gray-500' }} dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd" />
							</svg>
							<span class="text-sm {{ request()->is('complaints') ? 'text-purple-700' : 'text-gray-500' }} dark:text-gray-400 dark:group-hover:text-purple-500">
								Pengaduan
							</span>
						</a>
						<a href="{{ route('profile.index') }}" class="group inline-flex flex-col items-center justify-center border-x border-gray-200 px-5 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
							<svg class="mb-2 h-5 w-5 {{ request()->is('profile') ? 'text-purple-700' : 'text-gray-500' }} dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
								<path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
							</svg>
							<span class="text-sm {{ request()->is('profile') ? 'text-purple-700' : 'text-gray-500' }} dark:text-gray-400 dark:group-hover:text-purple-500">
								Profil
							</span>
						</a>
					</div>
				</div>
			</nav>
			<main class="p-5 pb-20">
				@yield('content')
			</main>
		</div>
		@stack('modals')
		@stack('scripts')
	</body>

</html>
