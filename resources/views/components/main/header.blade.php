<div class="bg-purple-700 px-5 py-3">
	<div class="flex items-center gap-2">
		@if (isset($back))
			<a href="{{ $back }}">
        <svg class="w-6 h-6 text-slate-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14 8-4 4 4 4"/>
        </svg>              
			</a>
		@endif
		<h1 class="text-xl font-bold text-slate-200">{{ $title }}</h1>
	</div>
</div>
