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
		<div id="map" class="z-30" style="height: calc(100vh - 155px);"></div>
	</section>
@endsection
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
@endpush
