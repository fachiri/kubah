@extends('layouts.main')
@section('title', 'Artikel')
@section('header')
	<x-main.header title="Artikel" />
@endsection
@section('actions')
	@can('create', App\Models\Article::class)
		<section class="fixed bottom-20 left-0 flex w-full justify-center bg-none">
			<a href="{{ route('articles.create') }}" class="inline-flex items-center rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
				Buat Artikel
				<svg class="ms-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 12h14m-7 7V5" />
				</svg>
			</a>
		</section>
	@endcan
@endsection
@section('content')
	<x-alert />
	<section class="mb-5">
		<x-main.filter :route="route('articles.index')" />
	</section>
	<section class="mb-5">
		<ul class="max-w-md divide-y divide-gray-200 border dark:divide-gray-700">
			@if (count($articles) > 0)
				@foreach ($articles as $article)
					<li class="p-3 hover:bg-gray-200">
						<a href="{{ route('articles.show', $article->slug) }}" class="block">
							<div class="flex items-center space-x-4 rtl:space-x-reverse">
								<div class="min-w-0 flex-1">
									<p class="truncate text-sm font-medium text-gray-900 dark:text-white">
										{{ $article->title }}
									</p>
									<p class="truncate text-sm text-gray-500 dark:text-gray-400 mb-2">
										{{ strip_tags($article->content) }}
									</p>
									<p class="truncate text-xs text-gray-500 dark:text-gray-400">Diposting {{ $article->created_at->format('d M, Y. H:i') }} WITA</p>
								</div>
								<div class="inline-flex items-center">
									<x-badge.status-complaint :status="$article->status" />
								</div>
							</div>
						</a>
					</li>
				@endforeach
			@else
				<li class="p-3 text-center text-sm text-gray-700">
					Data tidak ditemukan
				</li>
			@endif
		</ul>
	</section>
	<section>
		{{ $articles->onEachSide(5)->links() }}
	</section>
@endsection
