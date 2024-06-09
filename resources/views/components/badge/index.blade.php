@foreach ($options as $option)
	@if ($value == $option->value)
		<span class="bg-{{ $option->color }}-100 text-{{ $option->color }}-800 dark:bg-{{ $option->color }}-900 dark:text-{{ $option->color }}-300 rounded px-2.5 py-0.5 text-xs font-medium">
			{{ $option->text ?? $value }}
		</span>
	@endif
@endforeach
