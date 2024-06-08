@extends('layouts.main')
@section('title', 'Home')
@section('header')
	<div class="px-5 pt-4">
		<h1 class="color-gradient text-center text-2xl font-bold">KuBah</h1>
	</div>
@endsection
@section('content')
	<section class="mb-5">
		<div id="indicators-carousel" class="relative w-full" data-carousel="slide">
			<!-- Carousel wrapper -->
			<div class="relative h-48 overflow-hidden rounded-lg">
				<div class="hidden duration-700 ease-in-out" data-carousel-item="active">
					<img src="{{ asset('images/carousel/carousel-1.jpg') }}" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="...">
				</div>
				<div class="hidden duration-700 ease-in-out" data-carousel-item>
					<img src="{{ asset('images/carousel/carousel-2.jpg') }}" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="...">
				</div>
				<div class="hidden duration-700 ease-in-out" data-carousel-item>
					<img src="{{ asset('images/carousel/carousel-3.jpg') }}" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="...">
				</div>
				<div class="hidden duration-700 ease-in-out" data-carousel-item>
					<img src="{{ asset('images/carousel/carousel-4.jpg') }}" class="absolute left-1/2 top-1/2 block w-full -translate-x-1/2 -translate-y-1/2" alt="...">
				</div>
			</div>
			<div class="absolute bottom-5 left-1/2 z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse">
				<button type="button" class="h-3 w-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
				<button type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
				<button type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
				<button type="button" class="h-3 w-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
			</div>
			<!-- Slider controls -->
			<button type="button" class="group absolute start-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none" data-carousel-prev>
				<span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
					<svg class="h-4 w-4 text-white rtl:rotate-180 dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
					</svg>
					<span class="sr-only">Previous</span>
				</span>
			</button>
			<button type="button" class="group absolute end-0 top-0 z-30 flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none" data-carousel-next>
				<span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/30 group-hover:bg-white/50 group-focus:outline-none group-focus:ring-4 group-focus:ring-white dark:bg-gray-800/30 dark:group-hover:bg-gray-800/60 dark:group-focus:ring-gray-800/70">
					<svg class="h-4 w-4 text-white rtl:rotate-180 dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
					</svg>
					<span class="sr-only">Next</span>
				</span>
			</button>
		</div>
	</section>
	<section>
		<div class="mb-3 flex items-center justify-between">
			<h4 class="text-xl font-bold">Artikel</h4>
			<a href="#" class="flex items-center font-bold text-purple-700">
				Semua
				<svg class="h-6 w-6 text-purple-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4" />
				</svg>
			</a>
		</div>
		<div class="grid grid-cols-2 gap-3">
			@foreach ($articles as $article)
				<div class="rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
					<a href="#">
						<img class="rounded-t-lg" src="{{ asset("storage/articles/$article->image") }}" alt="{{ $article->title }}" />
					</a>
					<div class="p-5">
						<a href="#">
							<h5 class="truncate-multiline mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $article->title }}</h5>
						</a>
						<p class="truncate-multiline text-sm font-normal text-gray-700 dark:text-gray-400">{{ $article->content }}</p>
					</div>
				</div>
			@endforeach
		</div>
	</section>
@endsection
