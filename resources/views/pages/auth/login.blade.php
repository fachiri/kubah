@extends('layouts.auth')
@section('title', 'Login')
@section('content')
	<div class="space-y-5 rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
		<h3 class="text-xl font-bold">Login</h3>
		<x-alert />
		<form id="login-form" action="{{ route('auth.login.authenticate') }}" method="POST" class="mx-auto">
			@csrf
			<div>
				<input type="hidden" value="" id="device_token" name="device_token">
				<x-form.input class="mb-5" type="email" name="email" label="Email" placeholder="contoh@gmail.com" autocomplete="email" />
				<x-form.input class="mb-5" type="password" name="password" label="Password" placeholder="**********" autocomplete="current-password" />
				<div class="mb-5 flex items-start">
					<div class="flex h-5 items-center">
						<input id="remember" type="checkbox" value="" class="focus:ring-3 h-4 w-4 rounded border border-gray-300 bg-gray-50 focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800" />
					</div>
					<label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ingat Saya</label>
				</div>
			</div>
			<button type="submit" class="w-full rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
		</form>
		<div class="flex items-center justify-between space-x-3 pt-1">
			<div class="flex-1 border" style="height: 1px"></div>
			<p class="text-gray-500">atau</p>
			<div class="flex-1 border" style="height: 1px"></div>
		</div>
		<div class="flex justify-between">
			<p>Belum punya akun?</p>
			<a href="{{ route('auth.register') }}" class="font-bold text-purple-700 underline">Register</a>
		</div>
	</div>
@endsection
@push('scripts')
	<script type="module">
		const loginForm = document.getElementById('login-form');
		const deviceTokenInput = document.getElementById('device_token');
		loginForm.addEventListener('submit', (e) => {
			e.preventDefault(deviceTokenInput.value);
			deviceTokenInput.value = sessionStorage.getItem('device_token');
			loginForm.submit();
		})
	</script>
@endpush
