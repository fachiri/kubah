@props([
  'class' => '',
  'label' => 'Submit'
])

<button
  type="submit"
  {{ $attributes->class(["w-full rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800", $class]) }}
>
  {{ $label }}
</button>