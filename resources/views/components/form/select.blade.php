<div class="{{ $class ?? '' }}">
	<label for="{{ $name }}" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
	<select id="{{ $name }}" name="{{ $name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500">
    <option value="" hidden>Pilih {{ $label }}</option>
		@foreach ($options as $option)
    	<option value="{{ $option->value }}">{{ $option->label }}</option>
		@endforeach
  </select>
</div>
