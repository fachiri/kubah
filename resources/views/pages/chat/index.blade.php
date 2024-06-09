@php
	$chats = [
	    (object) [
	        'id' => '1',
	        'subject' => 'Ingin berbicara tentang kekerasan dalam rumah tangga',
	        'status' => 'CLOSED',
	    ],
	    (object) [
	        'id' => '2',
	        'subject' => 'Butuh bantuan mengenai masalah anak yang terlantar',
	        'status' => 'OPEN',
	    ],
	    (object) [
	        'id' => '3',
	        'subject' => 'Memerlukan saran untuk kesehatan mental remaja',
	        'status' => 'CLOSED',
	    ],
	    (object) [
	        'id' => '4',
	        'subject' => 'Mengalami bullying di sekolah, perlu bantuan',
	        'status' => 'OPEN',
	    ],
	    (object) [
	        'id' => '5',
	        'subject' => 'Ingin melaporkan kekerasan seksual dan butuh dukungan',
	        'status' => 'CLOSED',
	    ],
	];
@endphp
@extends('layouts.main')
@section('title', 'Chat')
@section('header')
	<div class="px-5 pt-4">
		<h1 class="text-2xl font-bold text-gray-700">Chat</h1>
	</div>
@endsection
@section('content')
	<section class="fixed bottom-20 left-0 flex w-full justify-center bg-none">
		<a href="#" class="inline-flex items-center rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
			New Chat
			<svg class="ms-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 12h14m-7 7V5" />
			</svg>
		</a>
	</section>
	<section>
		<ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
			@foreach ($chats as $chat)
				<li class="p-3 hover:bg-gray-200">
					<a href="#" class="block">
						<div class="flex items-center space-x-4 rtl:space-x-reverse">
							<div class="flex-shrink-0">
								<div class="relative h-8 w-8 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
									<svg class="absolute -left-1 h-10 w-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
									</svg>
								</div>
							</div>
							<div class="min-w-0 flex-1">
								<p class="truncate text-sm font-medium text-gray-900 dark:text-white">
									Anonim
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
		</ul>
	</section>
@endsection
