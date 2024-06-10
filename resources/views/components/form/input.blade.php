@props([
	'class',
	'name',
	'label',
	'inputClass' => '',
	'type' => 'text',
	'placeholder' => '',
	'maxlength' => '',
	'value' => old($name)
])

<div class="{{ $class }}">
	<label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
		{{ $label }}
	</label>
	<input
		type="{{ $type }}"
		id="{{ $name }}"
		name="{{ $name }}"
		{{ $attributes->class(["block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500", $inputClass, 'border-red-700' => $errors->get($name)]) }}
		placeholder="{{ $placeholder }}"
		maxlength="{{ $maxlength }}"
		value="{{ $value }}"
	/>
	@error($name)
		<p class="mt-2 text-xs text-red-600 dark:text-red-500">
			{{ $message }}
		</p>
	@enderror
</div>
