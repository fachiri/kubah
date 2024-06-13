@extends('layouts.main')
@section('title', 'Mulai Konsultasi')
@section('header')
	<x-main.header title="Mulai Konsultasi" :back="route('chats.index')" />
@endsection
@section('content')
	<x-alert />
	<section>
		<form action="{{ route('chats.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<x-form.textarea class="mb-5" name="subject" label="Subjek" placeholder="Isi subjek konsultasi" />
			<label class="mb-5 inline-flex cursor-pointer items-center">
				<input type="checkbox" id="is-anonim" value="1" name="is_anonim" class="peer sr-only" checked>
				<div class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-purple-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rtl:peer-checked:after:-translate-x-full dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-purple-800"></div>
				<span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Anonim</span>
			</label>
			<div class="mb-5 flex items-center gap-3">
				<svg class="h-5 w-5 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
				</svg>
				<p id="is-anonim-helper-text" class="text-sm text-gray-500 dark:text-gray-400">
					Nama anda akan ditampilkan sebagai <b>Anonim</b>
				</p>
			</div>
			<x-button.submit label="Mulai" />
		</form>
	</section>
@endsection
@push('scripts')
	<script>
		const helperText = document.getElementById('is-anonim-helper-text');
		document.getElementById('is-anonim').addEventListener('change', e => {
			if (e.target.checked) {
				helperText.innerHTML = "Nama anda akan ditampilkan sebagai <b>Anonim</b>"
			} else {
				helperText.innerHTML = "Nama anda akan ditampilkan sebagai <b>{{ auth()->user()->name }}</b>"
			}
		})
	</script>
@endpush
