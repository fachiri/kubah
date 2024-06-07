@extends('layouts.auth')
@section('header', 'Login')
@section('content')
	<div class="space-y-5 rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
		<h3 class="text-xl font-bold">Login</h3>
		<form class="mx-auto">
			<div>
				<x-form.input class="mb-5" type="email" name="email" label="Email" placeholder="contoh@gmail.com" />
				<x-form.input class="mb-5" type="password" name="password" label="Password" placeholder="**********" />
				<div class="mb-5 flex items-start">
					<div class="flex h-5 items-center">
						<input id="remember" type="checkbox" value="" class="focus:ring-3 h-4 w-4 rounded border border-gray-300 bg-gray-50 focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600 dark:focus:ring-offset-gray-800" />
					</div>
					<label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ingat Saya</label>
				</div>
			</div>
			<button type="submit" class="w-full rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">Submit</button>
		</form>
		<div class="flex justify-between items-center space-x-3 pt-1">
			<div class="border flex-1" style="height: 1px"></div>
			<p class="text-gray-500">atau</p>
			<div class="border flex-1" style="height: 1px"></div>
		</div>
		<div class="flex justify-between">
			<p>Belum punya akun?</p>
			<a href="{{ route('auth.register') }}" class="font-bold text-purple-700 underline">Register</a>
		</div>
	</div>
@endsection
