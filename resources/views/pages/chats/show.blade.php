@php
	$items = [
	    (object) [
	        'label' => 'Status',
	        'value' => view('components.badge.status-chat', ['status' => $chat->status])->render(),
	        'literal' => true,
	    ],
	    (object) [
	        'label' => 'Subjek',
	        'value' => $chat->subject,
	    ],
	];

	if (auth()->user()->can('close', $chat)) {
	    $items[] = (object) [
	        'label' => 'Aksi',
	        'value' => view('components.button.index', ['label' => 'Tutup', 'color' => 'red', 'modal' => 'confirm-close-modal'])->render(),
	        'literal' => true,
	    ];
	}
@endphp
@extends('layouts.main')
@section('title', 'Konsultasi')
@section('header')
	<x-main.header title="Konsultasi" :back="route('chats.index')" />
@endsection
@section('content')
	<x-alert />
	<section>
		<x-main.list :items="$items" />
	</section>
	<section class="min-h-60 custom-scrollbar flex max-h-[calc(100vh-95px)] flex-col overflow-y-auto bg-slate-200 p-3">
		<div class="flex-grow space-y-3">
			@foreach ($chat->messages as $message)
				@if ($message->is_system == 1)
					<div class="flex justify-center gap-2.5">
						<div class="leading-1.5 flex max-w-[320px] flex-col p-2.5 text-center">
							<p class="mb-1 text-xs italic text-gray-900 dark:text-white">
								{{ $message->message }}
							</p>
							<span class="text-xs text-gray-500 dark:text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
						</div>
					</div>
				@elseif ($message->user_id == auth()->user()->id)
					<div class="flex justify-end gap-2.5">
						<div class="leading-1.5 flex max-w-[320px] flex-col bg-white p-2.5">
							<p class="mb-2 text-sm font-normal text-gray-900 dark:text-white">
								{{ $message->message }}
							</p>
							<span class="text-right text-xs font-normal text-gray-500 dark:text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
						</div>
					</div>
				@else
					<div class="flex items-start gap-2.5">
						<img src="{{ ($message->user->isVolunteer() && $message->user->avatar) || ($message->user->isCommonUser() && $message->user->avatar && $chat->is_anonim == 0) ? asset('storage/avatars/' . $message->user->avatar) : asset('images/placeholder/avatar.png') }}" alt="Profile" class="h-8 w-8 rounded-full border">
						<div class="leading-1.5 flex max-w-[320px] flex-col bg-white p-2.5">
							<div class="flex items-center space-x-2 rtl:space-x-reverse">
								<span class="text-sm font-semibold text-gray-900 dark:text-white">
									{{ $message->user->isCommonUser() && $message->chat->is_anonim == 1 ? 'Anonim' : $message->user->name }}
								</span>
								@if ($message->user->isVolunteer())
									<span class="me-2 rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">Relawan</span>
								@endif
							</div>
							<p class="my-2 text-sm font-normal text-gray-900 dark:text-white">
								{{ $message->message }}
							</p>
							<span class="text-right text-xs font-normal text-gray-500 dark:text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
						</div>
					</div>
				@endif
			@endforeach
		</div>
		@can('create', [App\Models\Message::class, $chat])
			<div class="mt-3">
				<form action="{{ route('messages.store', $chat->ulid) }}" method="POST">
					@csrf
					<div class="relative">
						<textarea name="message" class="scrollbar-none block h-16 w-full resize-none rounded-lg border border-gray-300 bg-gray-50 p-4 pe-20 text-sm text-gray-900 focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500" placeholder="Ketik pesan"></textarea>
						<input type="hidden" name="chat_id" value="{{ $chat->id }}" />
						<div class="absolute inset-y-0 end-2.5 flex items-center">
							<button type="submit" class="rounded-lg bg-purple-700 px-4 py-2 text-sm font-medium text-white hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
								Kirim
							</button>
						</div>
					</div>
				</form>
			</div>
		@endcan
	</section>
@endsection
@push('modals')
	<x-modal.confirm id="confirm-close-modal" :action="route('chats.close', $chat->ulid)" method="PATCH" text="Tutup sesi konsultasi ini?" color="red" />
@endpush
