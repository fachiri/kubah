@extends('layouts.main')
@section('title', 'Edit Profil')
@section('header')
	<x-main.header title="Edit Profil" :back="route('profile.index')" />
@endsection
@section('content')
	<x-alert />
	<section>
		<form id="update-avatar-form" action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PATCH')
			<img class="mx-auto mb-5 h-24 w-24 rounded-full border shadow-lg" src="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : asset('images/placeholder/avatar.png') }}" alt="Profile image">
			<div class="flex justify-center">
				<label for="update-avatar-input" class="bg-purple-700 hover:bg-purple-800 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 inline-flex items-center rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:outline-none focus:ring-4 cursor-pointer">
					Pilih Foto
				</label>
				<input type="file" name="avatar" id="update-avatar-input" class="hidden">
			</div>
		</form>
	</section>
	<section>
		<form action="{{ route('profile.update') }}" method="POST">
			@csrf
			@method('PATCH')
			<x-form.input class="mb-5" name="name" label="Nama Lengkap" placeholder="Isi nama lengkap" :value="$user->name" />
			<x-form.select class="mb-5" name="gender" label="Jenis Kelamin" :value="$user->gender" :options="[
			    (object) [
			        'label' => 'Laki-laki',
			        'value' => 'Laki-laki',
			    ],
			    (object) [
			        'label' => 'Perempuan',
			        'value' => 'Perempuan',
			    ],
			]" />
			<x-form.input class="mb-5" name="birth_place" label="Tempat Lahir" placeholder="Isi tempat lahir" :value="$user->birth_place" />
			<x-form.input class="mb-5" type="date" name="birth_date" label="Tanggal Lahir" :value="$user->birth_date" />
			<x-form.textarea class="mb-5" name="address" label="Alamat" placeholder="Isi alamat" :value="$user->address" />
			<x-form.input class="mb-5" input-class="phone-id" type="tel" name="phone" label="No. HP" placeholder="Isi nomor HP" maxlength="12" :value="$user->phone" />
			<x-button.submit label="Update" />
		</form>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/phone-input-format-id.js') }}"></script>
	<script>
		document.getElementById('update-avatar-input').addEventListener('change', function() {
			document.getElementById('update-avatar-form').submit();
		});
	</script>
@endpush
