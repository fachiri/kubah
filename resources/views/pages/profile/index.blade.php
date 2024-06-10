@extends('layouts.main')
@section('title', 'Profil')
@section('header')
	<div class="px-5 py-3 bg-purple-700">
		<h1 class="text-xl font-bold text-slate-200">Profil</h1>
	</div>
@endsection
@section('content')
	<section class="mb-5">
		<div class="flex flex-col items-center">
			<img class="mb-3 h-24 w-24 rounded-full shadow-lg" src="{{ asset('images/placeholder/profile.jpg') }}" alt="Profile image" />
			<h5 class="mb-1 text-xl font-medium text-gray-700 dark:text-white">Bonnie Green</h5>
			<span class="text-sm text-gray-500 dark:text-gray-400">Visual Designer</span>
		</div>
	</section>
	<section>
		<ul class="space-y-3">
			<li class="p-3 hover:bg-gray-200 border rounded">
				<a href="#" class="block">
					<div class="flex items-center space-x-4 rtl:space-x-reverse">
						<div class="min-w-0 flex-1">
							<p class="truncate text-sm font-semibold text-gray-700 dark:text-white">
								Informasi Pengguna
							</p>
						</div>
						<div class="inline-flex items-center">
							<svg class="w-6 h-6 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
								<path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
							</svg>							
						</div>
					</div>
				</a>
			</li>
			<li class="p-3 hover:bg-gray-200 border rounded">
				<a href="#" class="block">
					<div class="flex items-center space-x-4 rtl:space-x-reverse">
						<div class="min-w-0 flex-1">
							<p class="truncate text-sm font-semibold text-gray-700 dark:text-white">
								Keamanan Akun
							</p>
						</div>
						<div class="inline-flex items-center">
							<svg class="w-6 h-6 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z"/>
							</svg>							
						</div>
					</div>
				</a>
			</li>
			<li class="p-3 hover:bg-gray-200 border rounded">
				<a href="#" class="block">
					<div class="flex items-center space-x-4 rtl:space-x-reverse">
						<div class="min-w-0 flex-1">
							<p class="truncate text-sm font-semibold text-red-700 dark:text-white">
								Keluar
							</p>
						</div>
						<div class="inline-flex items-center">
							<svg class="w-6 h-6 text-red-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
							</svg>							
						</div>
					</div>
				</a>
			</li>
		</ul>
	</section>
@endsection
