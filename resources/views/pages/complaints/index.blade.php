@php
	$complaints = [
	    (object) [
	        'id' => '1',
	        'category' => 'Physical Harassment',
	        'description' => 'Suami saya memukul saya beberapa kali selama sebuah argumen.',
	        'location' => '123 Jalan Utama, Kotakota',
	        'status' => 'PENDING',
	        'reporter_role' => 'Korban', // Possible values: 'Korban', 'Anggota Keluarga', 'Teman', dll.
	        'incident_date' => '2024-05-01',
	        'incident_time' => '18:30',
	        'evidence' => ['foto1.jpg', 'laporan_medis.pdf'],
	    ],
	    (object) [
	        'id' => '2',
	        'category' => 'Child Neglect',
	        'description' => 'Seorang anak di lingkungan kami sering ditinggal sendirian tanpa pengawasan.',
	        'location' => '456 Jalan Elm, Kotalain',
	        'status' => 'PENDING',
	        'reporter_role' => 'Tetangga',
	        'incident_date' => '2024-06-02',
	        'incident_time' => '14:00',
	        'evidence' => ['foto2.jpg', 'video.mp4'],
	    ],
	    (object) [
	        'id' => '3',
	        'category' => 'Sexual Assault',
	        'description' => 'Saya diserang oleh rekan kerja pada sebuah acara perusahaan.',
	        'location' => '789 Jalan Oak, Kotakamu',
	        'status' => 'RESOLVED',
	        'reporter_role' => 'Korban',
	        'incident_date' => '2024-04-20',
	        'incident_time' => '21:00',
	        'evidence' => ['laporan_polisi.pdf'],
	    ],
	    (object) [
	        'id' => '4',
	        'category' => 'Mental Health Crisis',
	        'description' => 'Teman saya menunjukkan tanda-tanda depresi berat dan membutuhkan bantuan.',
	        'location' => '321 Jalan Pine, Kotaterus',
	        'status' => 'IN PROGRESS',
	        'reporter_role' => 'Teman',
	        'incident_date' => '2024-06-05',
	        'incident_time' => '10:00',
	        'evidence' => ['percakapan_teks.png'],
	    ],
	    (object) [
	        'id' => '5',
	        'category' => 'Domestic Violence',
	        'description' => 'Saya mendengar teriakan keras dan pertengkaran dari rumah tetangga saya.',
	        'location' => '654 Jalan Maple, Kotalahir',
	        'status' => 'PENDING',
	        'reporter_role' => 'Tetangga',
	        'incident_date' => '2024-05-15',
	        'incident_time' => '22:30',
	        'evidence' => ['rekaman_audio.mp3'],
	    ],
	];
@endphp
@extends('layouts.main')
@section('title', 'Pengaduan')
@section('header')
	<div class="px-5 py-3 bg-purple-700">
		<h1 class="text-xl font-bold text-slate-200">Pengaduan</h1>
	</div>
@endsection
@section('content')
	<section class="fixed bottom-20 left-0 flex w-full justify-center bg-none">
		<a href="#" class="inline-flex items-center rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
			Buat Pengaduan
			<svg class="ms-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
				<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 12h14m-7 7V5" />
			</svg>
		</a>
	</section>
	<section>
		<ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
			@foreach ($complaints as $complaint)
				<li class="p-3 hover:bg-gray-200">
					<a href="#" class="block">
						<div class="flex items-center space-x-4 rtl:space-x-reverse">
							<div class="min-w-0 flex-1">
								<p class="truncate text-sm font-medium text-gray-900 dark:text-white">
									{{ $complaint->category }}
								</p>
								<p class="truncate text-sm text-gray-500 dark:text-gray-400">
									{{ $complaint->description }}
								</p>
							</div>
							<div class="inline-flex items-center">
								<x-badge.status-complaint :status="$complaint->status" />
							</div>
						</div>
					</a>
				</li>
			@endforeach
		</ul>
	</section>
@endsection
