@props([
    'href' => null,
    'color' => 'blue',
    'icon' => null,
    'label',
    'modal'
])

@php
	$btnClass = "bg-$color-700 hover:bg-$color-800 focus:ring-$color-300 dark:bg-$color-600 dark:hover:bg-$color-700 dark:focus:ring-$color-800 inline-flex items-center rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:outline-none focus:ring-4";
@endphp

@if (isset($href))
	<a href="{{ $href }}" class="{{ $btnClass }}">
		@if (isset($icon))
			<svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
				{{ $icon }}
			</svg>
		@endif
		{{ $label }}
	</a>
@else
	<button {{ $attributes->class([$btnClass])->merge(['type' => 'button', 'data-modal-target' => $modal, 'data-modal-toggle' => $modal]) }}>
		@if (isset($icon))
			<svg class="me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
				{{ $icon }}
			</svg>
		@endif
		{{ $label }}
	</button>
@endif
