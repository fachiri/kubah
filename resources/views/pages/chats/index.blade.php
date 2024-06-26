@extends('layouts.main')
@section('title', 'Chat')
@section('header')
	<div class="bg-purple-700 px-5 py-3">
		<h1 class="text-xl font-bold text-slate-200">Konsultasi</h1>
	</div>
@endsection
@section('actions')
	@can('create', App\Models\Chat::class)
		<a href="{{ route('chats.create') }}" class="inline-flex items-center rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 sm:bg-purple-600 sm:w-full sm:justify-center sm:hover:bg-purple-600">
			Mulai Konsultasi
			<svg class="ms-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 12h14m-7 7V5" />
			</svg>
		</a>
	@endcan
@endsection
@section('content')
	<x-alert />
	<section>
		<x-main.filter :route="route('chats.index')" />
	</section>
	<section>
		<ul class="max-w-md divide-y divide-gray-200 border dark:divide-gray-700">
			@if (count($chats) > 0)
			@foreach ($chats as $chat)
				<li class="p-3 hover:bg-gray-200">
					<a href="{{ route('chats.show', $chat->ulid) }}" class="block">
						<div class="flex items-center space-x-4 rtl:space-x-reverse">
							<img src="{{ $chat->is_anonim == 0 && $chat->common_user->user->avatar ? asset('storage/avatars/' . $chat->common_user->user->avatar) : asset('images/placeholder/avatar.png') }}" alt="Profile" class="h-8 w-8 rounded-full border">
							<div class="min-w-0 flex-1">
								<p class="truncate text-sm font-medium text-gray-900 dark:text-white">
									{{ $chat->is_anonim == 0 ? $chat->common_user->user->name : 'Anonim' }}
								</p>
								<p class="truncate text-sm text-gray-500 dark:text-gray-400">
									{{ $chat->subject }}
								</p>
							</div>
							<div class="inline-flex items-center">
								<x-badge.status-chat :status="$chat->status" />
							</div>
						</div>
					</a>
				</li>
			@endforeach
			@else
				<li class="p-3 text-center text-sm text-gray-700">
					Data tidak ditemukan
				</li>
			@endif
		</ul>
	</section>
	<section>
		{{ $chats->onEachSide(5)->links() }}
	</section>
@endsection
