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
	<section class="flex flex-wrap gap-3">
		@can('update', $complaint)
			<x-button href="{{ route('complaints.edit', $complaint->ulid) }}" label="Edit" color="green">
				<x-slot:icon>
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
				</x-slot>
			</x-button>
		@endcan
		@can('delete', $complaint)
			<x-button label="Hapus" color="red" modal="confirm-delete-modal">
				<x-slot:icon>
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
				</x-slot>
			</x-button>
		@endcan
		@can('cancel', $complaint)
			<x-button label="Batalkan" color="red" modal="confirm-cancel-modal">
				<x-slot:icon>
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
				</x-slot>
			</x-button>
		@endcan
		@can('process', $complaint)
			<x-button label="Proses" modal="confirm-process-modal">
				<x-slot:icon>
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
				</x-slot>
			</x-button>
		@endcan
		@can('resolve', $complaint)
			<x-button label="Selesai" modal="confirm-resolve-modal" color="green">
				<x-slot:icon>
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
				</x-slot>
			</x-button>
		@endcan
		<x-button label="PDF" color="gray">
			<x-slot:icon>
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z" />
			</x-slot>
		</x-button>
	</section>
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
@push('modals')
	<x-modal.confirm id="confirm-cancel-modal" :action="route('complaints.cancel', $complaint->ulid)" text="Anda akan membatalkan pengaduan?" color="red" />
	<x-modal.confirm id="confirm-delete-modal" :action="route('complaints.destroy', $complaint->ulid)" method="DELETE" text="Anda akan menghapus pengaduan?" color="red" />
	<x-modal.confirm id="confirm-process-modal" :action="route('complaints.process', $complaint->ulid)" method="POST" text="Proses pengaduan?" label-button="Ya, proses" />
	<x-modal.confirm id="confirm-resolve-modal" :action="route('complaints.resolve', $complaint->ulid)" method="POST" text="Pengaduan telah selesai?" label-button="Ya, selesaikan" color="green" />
@endpush
