@php
	use App\Constants\ViolenceCategory;
	use App\Constants\ReporterRole;
@endphp
@extends('layouts.main')
@section('title', 'Edit Pengaduan')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond-plugin-image-preview.css') }}">
@endpush
@section('header')
	<x-main.header title="Edit Pengaduan" :back="route('complaints.show', $complaint->ulid)" />
@endsection
@section('content')
	<x-alert />
	<section>
		<form action="{{ route('complaints.update', $complaint->ulid) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<h5 class="mb-5 font-bold">Bagian 1 - Data Diri</h5>
			<x-form.select class="mb-5" name="reporter_role" label="Status Pelapor" :value="$complaint->reporter_role" :options="ReporterRole::all()->map(function ($data) {
			    return (object) [
			        'label' => $data,
			        'value' => $data,
			    ];
			})" />
			<x-form.input class="mb-5" input-class="input-ktp" type="file" name="ktp" label="KTP" />
			<h5 class="mb-5 font-bold">Bagian 2 - Kejadian</h5>
			<x-form.select class="mb-5" name="category" label="Kategori" :value="$complaint->category" :options="ViolenceCategory::all()->map(function ($data) {
			    return (object) [
			        'label' => $data['name'],
			        'value' => $data['name'],
			    ];
			})" />
			<x-form.textarea class="mb-5" name="description" label="Deskripsi Kejadian" placeholder="Isi deskripsi" :value="$complaint->description" />
			<x-form.input class="mb-5" name="location" label="Lokasi Kejadian" placeholder="Isi lokasi kejadian" :value="$complaint->location" />
			<x-form.input class="mb-5" type="date" name="incident_date" label="Tanggal Kejadian" :value="$complaint->incident_date" />
			<x-form.input class="mb-5" type="time" name="incident_time" label="Waktu Kejadian" :value="$complaint->incident_time" />
			<x-form.input class="mb-5" input-class="evidences" type="file" name="evidences[]" label="Bukti" multiple />
			<div class="mb-5 space-y-3">
				@foreach ($complaint->evidences as $evidence)
					<div class="flex justify-between items-center">
						<a href="{{ asset('storage/evidences/' . $evidence->filename) }}" target="_blank" class="text-purple-700 underline">View File</a>
						<a href="#">
							<svg class="w-5 h-5 text-red-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
							</svg>							
						</a>
					</div>
				@endforeach
			</div>
			<x-button.submit />
		</form>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/jquery.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-size.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-type.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-crop.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-exif-orientation.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-filter.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-preview.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-resize.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond.js') }}"></script>
	<script>
		FilePond.registerPlugin(
			FilePondPluginImagePreview,
			FilePondPluginImageCrop,
			FilePondPluginImageExifOrientation,
			FilePondPluginImageFilter,
			FilePondPluginImageResize,
			FilePondPluginFileValidateSize,
			FilePondPluginFileValidateType,
		)

		FilePond.create(document.querySelector(".evidences"), {
			credits: null,
			allowImagePreview: true,
			allowImageFilter: false,
			allowImageExifOrientation: false,
			allowImageCrop: false,
			acceptedFileTypes: [
				"image/png",
				"image/jpg",
				"image/jpeg",
				"image/webp",
				"audio/mpeg", // .mp3
				"audio/wav", // .wav
				"audio/ogg", // .ogg
				"video/mp4", // .mp4
				"video/webm", // .webm
				"video/ogg", // .ogg
				"application/pdf", // .pdf
				"application/zip", // .zip
				"application/x-zip-compressed", // .zip
				"application/x-rar-compressed", // .rar
				"application/x-tar", // .tar
				"application/gzip", // .gz
				"application/x-7z-compressed" // .7z
			],
			maxFileSize: '10MB',
			fileValidateTypeDetectType: (source, type) =>
				new Promise((resolve, reject) => {
					resolve(type)
				}),
			storeAsFile: true,
		})

		FilePond.create(document.querySelector(".input-ktp"), {
			files: [{
				source: "{{ $complaint->ktp }}",
				options: {
					type: 'local',
				},
			}],
			server: {
				load: (id, load) => {
					fetch("{{ route('filepond.load.file', ['filepath' => 'storage/ktp/' . $complaint->ktp]) }}").then(res => res.blob()).then(load)
				}
			},
			credits: null,
			allowImagePreview: true,
			allowImageFilter: false,
			allowImageExifOrientation: false,
			allowImageCrop: false,
			acceptedFileTypes: [
				"image/png",
				"image/jpg",
				"image/jpeg",
				"image/webp"
			],
			maxFileSize: '10MB',
			fileValidateTypeDetectType: (source, type) =>
				new Promise((resolve, reject) => {
					resolve(type)
				}),
			storeAsFile: true,
		})
	</script>
@endpush
