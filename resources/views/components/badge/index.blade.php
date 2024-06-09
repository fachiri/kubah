@foreach ($options as $option)
	@if ($value == $option->value)
		@switch($option->color)
			@case('blue')
				<span class="rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
					{{ $option->text ?? $value }}
				</span>
			@break

			@case('gray')
				<span class="rounded bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-900 dark:text-gray-300">
					{{ $option->text ?? $value }}
				</span>
			@break

			@case('red')
				<span class="rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
					{{ $option->text ?? $value }}
				</span>
			@break

			@case('green')
				<span class="rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
					{{ $option->text ?? $value }}
				</span>
			@break

			@case('yellow')
				<span class="rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
					{{ $option->text ?? $value }}
				</span>
			@break

			@case('indigo')
				<span class="rounded bg-indigo-100 px-2.5 py-0.5 text-xs font-medium text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
					{{ $option->text ?? $value }}
				</span>
			@break

			@case('purple')
				<span class="rounded bg-purple-100 px-2.5 py-0.5 text-xs font-medium text-purple-800 dark:bg-purple-900 dark:text-purple-300">
					{{ $option->text ?? $value }}
				</span>
			@break

			@case('pink')
				<span class="rounded bg-pink-100 px-2.5 py-0.5 text-xs font-medium text-pink-800 dark:bg-pink-900 dark:text-pink-300">
					{{ $option->text ?? $value }}
				</span>
			@break

			@default
				<span class="rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
					{{ $option->text ?? $value }}
				</span>
		@endswitch
	@endif
@endforeach
