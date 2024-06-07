<div class="{{ $class ?? '' }}">
	<label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
	<textarea id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-purple-500 focus:ring-purple-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-purple-500 dark:focus:ring-purple-500"></textarea>
</div>
