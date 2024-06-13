@props([
    'href' => null,
    'color' => 'blue',
    'icon' => null,
    'label',
    'modal' => null,
])

@php
	$styles = [
	    'blue' => 'bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
	    'gray' => 'bg-gray-700 hover:bg-gray-800 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800',
	    'red' => 'bg-red-700 hover:bg-red-800 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800',
	    'green' => 'bg-green-700 hover:bg-green-800 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
	    'yellow' => 'bg-yellow-700 hover:bg-yellow-800 focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800',
	    'indigo' => 'bg-indigo-700 hover:bg-indigo-800 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800',
	    'purple' => 'bg-purple-700 hover:bg-purple-800 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800',
	    'pink' => 'bg-pink-700 hover:bg-pink-800 focus:ring-pink-300 dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-800',
	];
	$colorClass = $styles[$color];
@endphp

@if (isset($href))
	<a href="{{ $href }}" class="{{ $colorClass }} inline-flex items-center rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
		@if (isset($icon))
			<svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
				{{ $icon }}
			</svg>
		@endif
		{{ $label }}
	</a>
@else
	<button {{ $attributes->class([$colorClass, 'inline-flex items-center rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:outline-none focus:ring-4'])->merge(['type' => 'button', 'data-modal-target' => $modal, 'data-modal-toggle' => $modal]) }}>
		@if (isset($icon))
			<svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
				{{ $icon }}
			</svg>
		@endif
		{{ $label }}
	</button>
@endif
