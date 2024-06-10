@extends('layouts.auth')
@section('title', 'Register')
@section('content')
	<div class="space-y-5 rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
		<div>
			<h3 class="text-xl font-bold">Register</h3>
			<h4>Lengkapi form dibawah ini</h4>
		</div>
		<x-alert />
		<form action="{{ route('auth.register.store') }}" method="POST" class="mx-auto">
			@csrf
			<div>
				<h5 class="font-bold mb-5">Bagian 1 - Personal</h5>
				<x-form.select class="mb-5" name="account_type" label="Jenis Akun" :options="[
				    (object) [
				        'label' => 'Relawan',
				        'value' => 'Relawan',
				    ],
				    (object) [
				        'label' => 'Masyarakat',
				        'value' => 'Masyarakat',
				    ],
				]" />
				<x-form.input class="mb-5" name="name" label="Nama Lengkap" placeholder="Isi nama lengkap" />
				<x-form.select class="mb-5" name="gender" label="Jenis Kelamin" :options="[
				    (object) [
				        'label' => 'Laki-laki',
				        'value' => 'Laki-laki',
				    ],
				    (object) [
				        'label' => 'Perempuan',
				        'value' => 'Perempuan',
				    ],
				]" />
				<x-form.input class="mb-5" name="birthplace" label="Tempat Lahir" placeholder="Isi tempat lahir" />
				<x-form.input class="mb-5" type="date" name="birthdate" label="Tanggal Lahir" />
				<x-form.textarea class="mb-5" name="address" label="Alamat" placeholder="Isi alamat" />
				<x-form.input class="mb-5" input-class="phone-id" type="tel" name="phone" label="No. HP" placeholder="Isi nomor HP" maxlength="12" />
			</div>
			<div>
				<h5 class="font-bold mb-5">Bagian 2 - Akun</h5>
				<x-form.input class="mb-5" name="email" label="Email" placeholder="Isi email" />
				<x-form.input class="mb-5" type="password" name="password" label="Password" placeholder="Isi password" />
				<x-form.input class="mb-5" type="password" name="password_confirmation" label="Konfirmasi Password" placeholder="Isi konfirmasi password" />
			</div>
			<button type="submit" class="w-full rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
		</form>
		<div class="flex justify-between items-center space-x-3 pt-1">
			<div class="border flex-1" style="height: 1px"></div>
			<p class="text-gray-500">atau</p>
			<div class="border flex-1" style="height: 1px"></div>
		</div>
		<div class="flex justify-between">
			<p>Sudah punya akun?</p>
			<a href="{{ route('auth.login') }}" class="font-bold text-purple-700 underline">Login</a>
		</div>
	</div>
@endsection
@push('scripts')
	<script src="{{ asset('js/phone-input-format-id.js') }}"></script>
@endpush
