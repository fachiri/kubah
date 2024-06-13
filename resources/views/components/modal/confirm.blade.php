@props([
	'action',
	'method' => 'POST',
	'id',
	'color' => 'blue',
	'text' => 'Anda yakin?',
	'labelButton' => 'Ya, saya yakin'
])
@php
	$styles = [
	    "red" => "bg-red-600 hover:bg-red-800 focus:ring-red-300 dark:focus:ring-red-800",
	    "orange" => "bg-orange-600 hover:bg-orange-800 focus:ring-orange-300 dark:focus:ring-orange-800",
	    "green" => "bg-green-600 hover:bg-green-800 focus:ring-green-300 dark:focus:ring-green-800",
	    "blue" => "bg-blue-600 hover:bg-blue-800 focus:ring-blue-300 dark:focus:ring-blue-800",
	    "yellow" => "bg-yellow-600 hover:bg-yellow-800 focus:ring-yellow-300 dark:focus:ring-yellow-800",
	];
	$buttonColor = $styles[$color];
@endphp
<x-modal :$id>
	<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}">
		@csrf
    @method($method)
		<svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
		</svg>
		<h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $text }}</h3>
		<button data-modal-hide="{{ $id }}" type="submit" class="{{ $buttonColor }} inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
			{{ $labelButton }}
		</button>
		<button data-modal-hide="{{ $id }}" type="button" class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-purple-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Tidak</button>
	</form>
</x-modal>
