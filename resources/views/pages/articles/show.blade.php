@extends('layouts.main')
@section('title', $article->title)
@section('header')
	<x-main.header title="Artikel" :back="request('from') ?? route('articles.index')" />
@endsection
@section('content')
	<x-alert />
	<section class="flex flex-wrap gap-3">
		@can('update', $article)
			<x-button href="{{ route('articles.edit', $article->ulid) }}" label="Edit" color="green">
				<x-slot:icon>
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
				</x-slot>
			</x-button>
		@endcan
		<x-button label="Salin Tautan" color="gray" id="copyButton">
			<x-slot:icon>
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
			</x-slot>
		</x-button>
	</section>
	<section>
		<div class="mb-5">
			<h3 class="mb-3 text-2xl font-bold">{{ $article->title }}</h3>
			<p class="flex items-center space-x-2 text-sm text-gray-700">
				<span>Diposting oleh <b class="text-gray-900">{{ $article->user->name }}</b></span>
				<span class="text-gray-500">•</span>
				<span class="text-gray-500">{{ $article->created_at->format('d M, Y') }}</span>
			</p>
		</div>
		<img src="{{ $article->image ? asset('storage/articles/' . $article->image) : asset('images/placeholder/avatar.png') }}" alt="Sampul Artikel" class="mb-5 w-full">
		<div>
			{!! $article->content !!}
		</div>
	</section>
@endsection
@push('scripts')
	<script>
		document.getElementById('copyButton').addEventListener('click', function() {
			const textToCopy = window.location.href; // Ganti dengan teks atau nilai yang ingin Anda salin
			navigator.clipboard.writeText(textToCopy)
				.then(() => {
					this.innerHTML = `
						<svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>
						</svg>
						Tautan disalin
					`;
				})
				.catch(err => {
					console.error('Gagal menyalin tautan: ', err);
					// Handle error, jika perlu
				});
		});
	</script>
@endpush
