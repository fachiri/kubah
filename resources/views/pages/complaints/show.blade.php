@php
	use Carbon\Carbon;
@endphp
@extends('layouts.main')
@section('title', 'Detail Pengaduan')
@section('header')
	<x-main.header title="Detail Pengaduan" :back="route('complaints.index')" />
@endsection
@section('content')
	<x-alert />
	<section>
		<x-main.list :items="[
		    (object) [
		        'label' => 'Status Pengaduan',
		        'value' => view('components.badge.status-complaint', ['status' => $complaint->status])->render(),
		        'literal' => true,
		    ],
		    (object) [
		        'label' => 'Tanggal Pengaduan',
		        'value' => Carbon::parse($complaint->created_at)->translatedFormat('d/m/Y H:i:s'),
		    ],
		    (object) [
		        'label' => 'Status Pelapor',
		        'value' => $complaint->reporter_role,
		    ],
		    (object) [
		        'label' => 'KTP',
		        'value' => asset('storage/ktp/' . $complaint->ktp),
		        'file' => true,
		    ],
		    (object) [
		        'label' => 'Kategori Kekerasan',
		        'value' => $complaint->category,
		    ],
		    (object) [
		        'label' => 'Deskripsi Kejadian',
		        'value' => $complaint->description,
		    ],
		    (object) [
		        'label' => 'Lokasi Kejadian',
		        'value' => $complaint->location,
		    ],
		    (object) [
		        'label' => 'Tanggal Kejadian',
		        'value' => Carbon::parse($complaint->incident_date)->translatedFormat('d/m/Y'),
		    ],
		    (object) [
		        'label' => 'Waktu Kejadian',
		        'value' => Carbon::parse($complaint->incident_time)->translatedFormat('H:i'),
		    ],
		    (object) [
		        'label' => 'Bukti',
		        'values' => $complaint->evidences->map(function ($evidence) {
		            return (object) [
		                'label' => $evidence->filename,
		                'value' => asset('storage/evidences/' . $evidence->filename),
		                'file' => true,
		            ];
		        }),
		    ],
		]" />
	</section>
@endsection
