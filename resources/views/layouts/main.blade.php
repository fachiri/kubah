<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') - {{ config('app.name') }}</title>
		@include('includes.head')
		<style>
			::-webkit-scrollbar {
				width: 5px;
			}

			/* Track */
			::-webkit-scrollbar-track {
				background: #ffffff;
			}

			/* Handle */
			::-webkit-scrollbar-thumb {
				background: #d8d8d8;
				border-radius: 5px;
			}

			/* Handle on hover */
			::-webkit-scrollbar-thumb:hover {
				background: #d1d1d1;
			}

			.scrollbar-none {
				&::-webkit-scrollbar {
					display: none;
				}
			}

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
		@stack('css')
	</head>

	<body class="bg-slate-300">
		<aside id="default-sidebar" class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full transition-transform sm:translate-x-0" aria-label="Sidebar">
			<div class="flex h-full flex-col overflow-y-auto bg-purple-700 px-3 py-4">
				<a href="/home" class="mb-4 flex border-b-2 border-purple-500 pb-3">
					<img src="{{ asset('images/icons/icon-144x144.png') }}" class="me-3 h-8" alt="KuBah Logo" />
					<h1 class="w-fit text-2xl font-bold text-slate-200">KuBah</h1>
				</a>
				<ul class="grow space-y-2 font-medium">
					<li>
						<a href="/home" class="{{ request()->is('home') ? 'bg-purple-600' : '' }} group flex items-center rounded-lg p-2 text-white hover:bg-purple-600">
							<svg class="h-5 w-5 text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
								<path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
							</svg>
							<span class="ms-3">Beranda</span>
						</a>
					</li>
					<li>
						<a href="/emergencies" class="{{ request()->is('emergencies') ? 'bg-purple-600' : '' }} group flex items-center rounded-lg p-2 text-white hover:bg-purple-600">
							<svg class="h-5 w-5 text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
								<path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd" />
							</svg>
							<span class="ms-3 grow">Darurat</span>
							@if (auth()->user()->isAdmin())
								<span class="rounded-full border px-2 text-xs">{{ App\Helpers\Setting::get('panic_button') }}</span>
							@endif
						</a>
					</li>
					@can('viewAny', App\Models\Chat::class)
						<li>
							<a href="/chats" class="{{ request()->is('chats') ? 'bg-purple-600' : '' }} group flex items-center rounded-lg p-2 text-white hover:bg-purple-600">
								<svg class="h-5 w-5 text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
									<path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd" />
									<path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd" />
								</svg>
								<span class="ms-3">Konsultasi</span>
							</a>
						</li>
					@endcan
					<li>
						<a href="/articles" class="{{ request()->is('articles') ? 'bg-purple-600' : '' }} group flex items-center rounded-lg p-2 text-white hover:bg-purple-600">
							<svg class="h-5 w-5 text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
								<path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd" />
							</svg>
							<span class="ms-3">Artikel</span>
						</a>
					</li>
					@can('viewAny', App\Models\Complaint::class)
						<li>
							<a href="/complaints" class="{{ request()->is('complaints') ? 'bg-purple-600' : '' }} group flex items-center rounded-lg p-2 text-white hover:bg-purple-600">
								<svg class="h-5 w-5 text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
									<path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd" />
								</svg>
								<span class="ms-3">Pengaduan</span>
							</a>
						</li>
					@endcan
					<li>
						<a href="/profile" class="{{ request()->is('profile') ? 'bg-purple-600' : '' }} group flex items-center rounded-lg p-2 text-white hover:bg-purple-600">
							<svg class="h-5 w-5 text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
								<path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
							</svg>
							<span class="ms-3">Profil</span>
						</a>
					</li>
				</ul>
				<div>
					@yield('actions')
				</div>
			</div>
		</aside>

		<div class="sm:ml-64">
			<div class="mx-auto min-h-screen max-w-md bg-white sm:max-w-none">
				<header>
					@yield('header')
				</header>
				<nav class="fixed bottom-0 left-0 z-40 flex w-full justify-center sm:hidden">
					<div class="h-16 w-full max-w-md border-t border-gray-200 bg-white dark:border-gray-600 dark:bg-gray-700">
						<div class="mx-auto grid h-full max-w-lg grid-cols-4 font-medium">
							<a href="{{ route('home.index') }}" class="group inline-flex flex-col items-center justify-center border-x border-gray-200 px-5 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
								<svg class="{{ request()->is('home') ? 'text-purple-700' : 'text-gray-500' }} mb-2 h-5 w-5 dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
									<path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
								</svg>
								<span class="{{ request()->is('home') ? 'text-purple-700' : 'text-gray-500' }} text-sm dark:text-gray-400 dark:group-hover:text-purple-500">
									Beranda
								</span>
							</a>
							@can('viewAny', App\Models\Chat::class)
								<a href="{{ route('chats.index') }}" class="group inline-flex flex-col items-center justify-center border-e border-gray-200 px-5 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
									<svg class="{{ request()->is('chats') ? 'text-purple-700' : 'text-gray-500' }} mb-2 h-5 w-5 dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
										<path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd" />
										<path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd" />
									</svg>
									<span class="{{ request()->is('chats') ? 'text-purple-700' : 'text-gray-500' }} text-sm dark:text-gray-400 dark:group-hover:text-purple-500">
										Konsultasi
									</span>
								</a>
							@endcan
							@if (auth()->user()->isAdmin() || auth()->user()->isVolunteer())
								<a href="{{ route('articles.index') }}" class="group inline-flex flex-col items-center justify-center border-e border-gray-200 px-5 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
									<svg class="{{ request()->is('articles') ? 'text-purple-700' : 'text-gray-500' }} mb-2 h-5 w-5 dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
										<path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd" />
									</svg>
									<span class="{{ request()->is('articles') ? 'text-purple-700' : 'text-gray-500' }} text-sm dark:text-gray-400 dark:group-hover:text-purple-500">
										Artikel
									</span>
								</a>
							@endif
							@can('viewAny', App\Models\Complaint::class)
								<a href="{{ route('complaints.index') }}" class="group inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800">
									<svg class="{{ request()->is('complaints') ? 'text-purple-700' : 'text-gray-500' }} mb-2 h-5 w-5 dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
										<path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd" />
									</svg>
									<span class="{{ request()->is('complaints') ? 'text-purple-700' : 'text-gray-500' }} text-sm dark:text-gray-400 dark:group-hover:text-purple-500">
										Pengaduan
									</span>
								</a>
							@endcan
							<a href="{{ route('profile.index') }}" class="group inline-flex flex-col items-center justify-center border-x border-gray-200 px-5 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-800">
								<svg class="{{ request()->is('profile') ? 'text-purple-700' : 'text-gray-500' }} mb-2 h-5 w-5 dark:text-gray-400 dark:group-hover:text-purple-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
									<path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
								</svg>
								<span class="{{ request()->is('profile') ? 'text-purple-700' : 'text-gray-500' }} text-sm dark:text-gray-400 dark:group-hover:text-purple-500">
									Profil
								</span>
							</a>
						</div>
					</div>
				</nav>
				<main class="space-y-5 p-5 pb-20">
					@yield('content')
				</main>
				<div class="fixed bottom-20 left-0 flex w-full justify-center bg-none sm:hidden">
					@yield('actions')
				</div>
			</div>
		</div>
		@stack('modals')
		@stack('scripts')
	</body>

</html>
