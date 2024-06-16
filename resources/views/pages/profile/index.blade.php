@extends('layouts.main')
@section('title', 'Profil')
@section('header')
	<div class="bg-purple-700 px-5 py-3">
		<h1 class="text-xl font-bold text-slate-200">Profil</h1>
	</div>
@endsection
@section('content')
	<x-alert />
	<section class="mb-5">
		<div class="flex flex-col items-center">
			<img class="mb-3 h-24 w-24 rounded-full border shadow-lg" src="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : asset('images/placeholder/avatar.png') }}" alt="Profile image">
			<h5 class="text-xl font-medium text-gray-700 dark:text-white">{{ auth()->user()->name }}</h5>
			<span class="mb-2 text-sm text-gray-500 dark:text-gray-400">
				{{ auth()->user()->email }}
			</span>
			<span class="rounded px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
				@if (auth()->user()->manager)
					Pimpinan
				@elseif (auth()->user()->admin)
					Admin
				@elseif (auth()->user()->volunteer)
					Relawan
				@elseif (auth()->user()->common_user)
					Masyarakat
				@else
					-
				@endif
			</span>
		</div>
	</section>
	<section>
		<ul class="space-y-3">
			<li class="rounded border p-3 hover:bg-gray-200">
				<a href="{{ route('profile.edit') }}" class="flex w-full items-center justify-between">
					<p class="truncate text-sm font-semibold text-gray-700 dark:text-white">
						Informasi Pengguna
					</p>
					<svg class="h-6 w-6 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
					</svg>
				</a>
			</li>
			<li class="rounded border p-3 hover:bg-gray-200">
				<a href="{{ route('security.index') }}" class="flex w-full items-center justify-between">
					<p class="truncate text-sm font-semibold text-gray-700 dark:text-white">
						Keamanan Akun
					</p>
					<svg class="h-6 w-6 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1Z" />
					</svg>
				</a>
			</li>
			<li class="rounded border p-3 hover:bg-gray-200">
				<button data-modal-target="confirm-logout-modal" data-modal-toggle="confirm-logout-modal" class="flex w-full items-center justify-between">
					<p class="truncate text-sm font-semibold text-red-700 dark:text-white">
						Keluar
					</p>
					<svg class="h-6 w-6 text-red-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
					</svg>
				</button>
			</li>
		</ul>
	</section>
@endsection
@push('modals')
	<div id="confirm-logout-modal" tabindex="-1" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
		<div class="relative max-h-full w-full max-w-md p-4">
			<div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
				<button type="button" class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirm-logout-modal">
					<svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
					</svg>
					<span class="sr-only">Close modal</span>
				</button>
				<div class="p-4 text-center md:p-5">
					<form action="{{ route('auth.logout') }}" method="POST">
						@csrf
						<svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
						</svg>
						<h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to logout?</h3>
						<button data-modal-hide="confirm-logout-modal" type="submit" class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-800">
							Yes, I'm sure
						</button>
						<button data-modal-hide="confirm-logout-modal" type="button" class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-purple-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">No, cancel</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endpush
@push('scripts')
	
@endpush
