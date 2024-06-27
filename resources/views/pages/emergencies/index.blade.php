@php
	use App\Constants\FeatureStatus;

	$panicButtonFeature = App\Helpers\Setting::get('panic_button');
@endphp
@extends('layouts.main')
@section('title', 'Keadaan Darurat')
@push('css')
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet-fullscreen/dist/leaflet.fullscreen.css" />
@endpush
@section('header')
	<x-main.header title="Keadaan Darurat" />
@endsection
@section('content')
	<x-alert />
	<section>
		@if (auth()->user()->isAdmin())
			<x-button label="Fitur Panic Button {{ $panicButtonFeature }}" modal="set-panic-button-feature-modal" :color="$panicButtonFeature == FeatureStatus::ACTIVE ? 'blue' : 'red'" />
		@endif
		@if (auth()->user()->isCommonUser() && $panicButtonFeature == FeatureStatus::ACTIVE)
			<button type="button" id="panic-button" data-modal-target="panic-button-modal" data-modal-toggle="panic-button-modal" class="inline-flex items-center rounded-full bg-red-700 px-5 py-2.5 text-center text-sm font-medium text-white ring-0 ring-gray-200 hover:bg-red-800 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
				<svg class="mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
				</svg>
				Panic Button
			</button>
		@endif
	</section>
	<section>
		<div id="map" class="z-30" style="height: calc(100vh - 155px);"></div>
	</section>
@endsection
@push('modals')
	@if (auth()->user()->isAdmin())
		<x-modal.confirm id="set-panic-button-feature-modal" :action="route('settings.panic_button')" text="Anda akan {{ $panicButtonFeature == FeatureStatus::ACTIVE ? 'menonaktifkan' : 'mengaktifkan' }} fitur Panic Button?" :color="$panicButtonFeature == FeatureStatus::ACTIVE ? 'red' : 'blue'" :label-button="$panicButtonFeature == FeatureStatus::ACTIVE ? 'Nonaktifkan' : 'Aktifkan'" />
	@endif
	@if (auth()->user()->isCommonUser() && $panicButtonFeature == FeatureStatus::ACTIVE)
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
	@endif
@endpush
@push('scripts')
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
	<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
	<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
	<script src="https://unpkg.com/leaflet-fullscreen/dist/Leaflet.fullscreen.min.js"></script>
	<script>
		const gorontaloBounds = L.latLngBounds(
			L.latLng(1.058404, 121.161003),
			L.latLng(0.174064, 123.568904)
		);
		const map = L.map('map', {
			// maxBounds: gorontaloBounds,
			maxBoundsViscosity: 1.0
		}).setView([0.5400, 123.0600], 9);
		const data = @json($emergencies);

		// map.setMaxBounds(gorontaloBounds);
		data.forEach(item => {
			const latlng = [item.latitude, item.longitude];
			let marker = L.marker(latlng).addTo(map);
			let popupContent = `
				<div class="">
					<div class="text-xs font-normal text-gray-500">Nama</div>
					<div class="text-sm font-medium text-gray-700">${item.user.name}</div>
				</div>
			`;
			marker.bindPopup(popupContent);
			// marker.on('mouseover', function() {
			// 	marker.openPopup();
			// });
		});
		map.addControl(new L.Control.Fullscreen({
			position: 'topright',
			title: 'View Full Screen',
		}));

		L.Control.geocoder().addTo(map);
		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			minZoom: 9,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}).addTo(map);
	</script>
	@if (auth()->user()->isCommonUser() && $panicButtonFeature == FeatureStatus::ACTIVE)
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
	@endif
@endpush
