@php
	use App\Constants\ViolenceCategory;
	use App\Constants\ReporterRole;
@endphp
@extends('layouts.main')
@section('title', 'Buat Pengaduan')
@section('header')
	<x-main.header title="Buat Pengaduan" :back="route('complaints.index')" />
@endsection
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond-plugin-image-preview.css') }}">
@endpush
@section('content')
  <x-alert />
	<section>
		<form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<h5 class="mb-5 font-bold">Bagian 1 - Data Diri</h5>
			<x-form.select class="mb-5" name="reporter_role" label="Status Pelapor" :options="ReporterRole::all()->map(function ($data) {
			    return (object) [
			        'label' => $data,
			        'value' => $data,
			    ];
			})" />
      <x-form.input class="mb-5" input-class="input-ktp" type="file" name="ktp" label="KTP" />
			<h5 class="mb-5 font-bold">Bagian 2 - Kejadian</h5>
			<x-form.select class="mb-5" name="category" label="Kategori" :options="ViolenceCategory::all()->map(function ($data) {
			    return (object) [
			        'label' => $data['name'],
			        'value' => $data['name'],
			    ];
			})" />
			<x-form.textarea class="mb-5" name="description" label="Deskripsi Kejadian" placeholder="Isi deskripsi" />
			<x-form.input class="mb-5" name="location" label="Lokasi Kejadian" placeholder="Isi lokasi kejadian" />
			<x-form.input class="mb-5" type="date" name="incident_date" label="Tanggal Kejadian" />
			<x-form.input class="mb-5" type="time" name="incident_time" label="Waktu Kejadian" />
			<x-form.input class="mb-5" input-class="evidences" type="file" name="evidences[]" label="Bukti" multiple />
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
