@extends('layouts.main')
@section('title', 'Keamanan Akun')
@section('header')
	<x-main.header title="Keamanan Akun" :back="route('profile.index')" />
@endsection
@section('content')
	<x-alert />
	<section>
		<form action="{{ route('security.change_password') }}" method="POST">
			@csrf
			@method('PATCH')
			<x-form.input class="mb-5" type="password" name="old_password" label="Password Lama" placeholder="Isi password lama" />
			<x-form.input class="mb-5" type="password" name="password" label="Password Baru" placeholder="Isi password baru" />
			<x-form.input class="mb-5" type="password" name="password_confirmation" label="Konfirmasi Password Baru" placeholder="Konfirmasi password baru" />
			<x-button.submit label="Ganti Password" />
		</form>
	</section>
@endsection
