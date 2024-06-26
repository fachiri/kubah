@extends('layouts.main')
@section('title', 'Home')
@section('header')
	<div class="px-5 pt-4 sm:hidden">
		<div class="flex items-start justify-between space-x-5">
			<div>
				<h1 class="color-gradient w-fit text-2xl font-bold">KuBah</h1>
				<h2 class="text-sm font-medium text-gray-500">Segera Laporkan Jika Mengalami Atau Menjadi Saksi Adanya Kekerasan Dalam Rumah Tangga dan Kekerasan Seksual!</h2>
			</div>
			<a href="{{ route('emergencies.index') }}" class="inline-flex items-center rounded-lg bg-red-500 p-2 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
				<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
				</svg>
			</a>
		</div>
	</div>
@endsection
@section('actions')
	<button type="button" id="panic-button" data-modal-target="panic-button-modal" data-modal-toggle="panic-button-modal" class="inline-flex items-center rounded-full bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white ring-4 ring-gray-200 hover:bg-red-800 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 sm:w-full sm:ring-0 sm:justify-center">
		<svg class="mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
		</svg>
		Panic Button
	</button>
@endsection
@section('content')
	<section class="mb-5">
		<div id="indicators-carousel" class="relative w-full" data-carousel="slide">
			<!-- Carousel wrapper -->
			<div class="relative h-48 overflow-hidden rounded-lg">
				@foreach ($carousels as $index => $carousel)
					<div class="duration-700 ease-in-out" data-carousel-item="{{ $index }}">
						<img src="{{ asset('storage/articles/' . $carousel->image) }}" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="Gambar artikel {{ $carousel->title }}">
					</div>
				@endforeach
			</div>

			<!-- Indicators -->
			<div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse">
				@foreach ($carousels as $index => $carousel)
					<button type="button" class="h-3 w-3 rounded-full" aria-current="{{ $index === 0 ? 'true' : '' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
				@endforeach
			</div>

			<!-- Slider controls -->
			<button type="button" class="group absolute start-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none" data-carousel-prev>
				<span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
					<svg class="h-4 w-4 text-white rtl:rotate-180 dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
					</svg>
					<span class="sr-only">Previous</span>
				</span>
			</button>
			<button type="button" class="group absolute end-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none" data-carousel-next>
				<span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
					<svg class="h-4 w-4 text-white rtl:rotate-180 dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
					</svg>
					<span class="sr-only">Next</span>
				</span>
			</button>
		</div>
	</section>

	<section>
		<div class="mb-3 flex items-center justify-between">
			<h4 class="text-xl font-bold">Artikel</h4>
			<a href="{{ route('articles.index') }}" class="flex items-center font-bold text-purple-700">
				Semua
				<svg class="h-6 w-6 text-purple-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4" />
				</svg>
			</a>
		</div>
		<div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
			@foreach ($articles as $article)
				<div class="rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
					<img class="rounded-t-lg" src="{{ asset("storage/articles/$article->image") }}" alt="{{ $article->title }}" />
					<div class="p-5">
						<a href="{{ route('articles.show', ['article' => $article->slug, 'from' => '/home']) }}">
							<h5 class="truncate-multiline mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $article->title }}</h5>
						</a>
						<p class="truncate-multiline text-sm font-normal text-gray-700 dark:text-gray-400">{{ strip_tags($article->content) }}</p>
					</div>
				</div>
			@endforeach
		</div>
	</section>
@endsection
@push('modals')
	<x-modal id="panic-button-modal">
		<form action="{{ route('emergencies.store') }}" method="POST">
			@csrf
			<input type="hidden" id="input-longitude" name="longitude">
			<input type="hidden" id="input-latitude" name="latitude">
			<svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
			</svg>
			<h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Kami akan membagikan lokasimu saat ini untuk membantu pengguna lain memberikan pertolongan secepatnya. <span class="font-bold">Izinkan akses lokasi untuk melanjutkan.</span></h3>
			<button data-modal-hide="panic-button-modal" id="panic-button-modal-submit" type="submit" class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 disabled:bg-red-300 dark:focus:ring-red-800" disabled>
				Bagikan Sekarang
			</button>
			<button data-modal-hide="panic-button-modal" type="button" class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-purple-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
				Tidak
			</button>
		</form>
	</x-modal>
@endpush
@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const inputLongitude = document.getElementById('input-longitude');
			const inputLatitude = document.getElementById('input-latitude');
			const panicButtonSubmit = document.getElementById('panic-button-modal-submit');
			const panicButton = document.getElementById('panic-button');

			if (panicButton) {
				panicButton.addEventListener('click', () => {
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(
							(position) => {
								inputLongitude.value = position.coords.longitude;
								inputLatitude.value = position.coords.latitude;
								panicButtonSubmit.removeAttribute('disabled');
							},
							(error) => {
								alert('Error obtaining location: ' + error.message);
							}, {
								enableHighAccuracy: true,
								timeout: 10000,
								maximumAge: 0
							}
						);
					} else {
						alert('Geolocation is not supported by your browser.');
					}
				});
			}
		});
	</script>
@endpush
