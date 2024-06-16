@php
	use App\Constants\ViolenceCategory;
	use App\Constants\ReporterRole;
@endphp
@extends('layouts.main')
@section('title', 'Edit Artikel')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond-plugin-image-preview.css') }}">
	<style>
		.ProseMirror:focus {
			outline: none;
		}

		.tiptap ul p,
		.tiptap ol p {
			display: inline;
		}

		.tiptap p.is-editor-empty:first-child::before {
			font-size: 14px;
			content: attr(data-placeholder);
			float: left;
			height: 0;
			pointer-events: none;
		}
	</style>
@endpush
@section('header')
	<x-main.header title="Edit Artikel" :back="route('articles.show', $article->slug)" />
@endsection
@section('content')
	<x-alert />
	<section>
		<form action="{{ route('articles.update', $article->slug) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<x-form.input class="mb-5" name="title" label="Judul Artikel" placeholder="Isi judul artikel" :value="$article->title" />
			<x-form.input class="mb-5" input-class="image" type="file" name="image" label="Sampul Artikel" />
			<!-- Tiptap -->
			<div class="mb-5">
				<label for="content" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
					Konten
				</label>
				<textarea name="content" class="hidden" id="input-content">{{ old('content') ?? $article->content }}</textarea>
				<div class="overflow-hidden rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900">
					<div id="hs-editor-tiptap">
						<div class="flex gap-x-0.5 border-b border-gray-200 p-2 align-middle">
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-bold="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M14 12a4 4 0 0 0 0-8H6v8"></path>
									<path d="M15 20a4 4 0 0 0 0-8H6v8Z"></path>
								</svg>
							</button>
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-italic="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="19" x2="10" y1="4" y2="4"></line>
									<line x1="14" x2="5" y1="20" y2="20"></line>
									<line x1="15" x2="9" y1="4" y2="20"></line>
								</svg>
							</button>
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-underline="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M6 4v6a6 6 0 0 0 12 0V4"></path>
									<line x1="4" x2="20" y1="20" y2="20"></line>
								</svg>
							</button>
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-strike="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M16 4H9a3 3 0 0 0-2.83 4"></path>
									<path d="M14 12a4 4 0 0 1 0 8H6"></path>
									<line x1="4" x2="20" y1="12" y2="12"></line>
								</svg>
							</button>
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-link="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
									<path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
								</svg>
							</button>
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-ol="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="10" x2="21" y1="6" y2="6"></line>
									<line x1="10" x2="21" y1="12" y2="12"></line>
									<line x1="10" x2="21" y1="18" y2="18"></line>
									<path d="M4 6h1v4"></path>
									<path d="M4 10h2"></path>
									<path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"></path>
								</svg>
							</button>
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-ul="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<line x1="8" x2="21" y1="6" y2="6"></line>
									<line x1="8" x2="21" y1="12" y2="12"></line>
									<line x1="8" x2="21" y1="18" y2="18"></line>
									<line x1="3" x2="3.01" y1="6" y2="6"></line>
									<line x1="3" x2="3.01" y1="12" y2="12"></line>
									<line x1="3" x2="3.01" y1="18" y2="18"></line>
								</svg>
							</button>
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-blockquote="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M17 6H3"></path>
									<path d="M21 12H8"></path>
									<path d="M21 18H8"></path>
									<path d="M3 12v6"></path>
								</svg>
							</button>
							<button class="size-8 inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 disabled:pointer-events-none disabled:opacity-50" type="button" data-hs-editor-code="">
								<svg class="size-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="m18 16 4-4-4-4"></path>
									<path d="m6 8-4 4 4 4"></path>
									<path d="m14.5 4-5 16"></path>
								</svg>
							</button>
						</div>
						<div class="h-[10rem] overflow-auto p-3" data-hs-editor-field=""></div>
					</div>
				</div>
			</div>
			<!-- End Tiptap -->
			@if (auth()->user()->isAdmin())
				<div class="mb-5">
					<label class="inline-flex cursor-pointer items-center">
						<input type="checkbox" name="is_featured" class="peer sr-only" {{ $article->is_featured == 1 ? 'checked' : '' }}>
						<div class="peer relative h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-purple-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rtl:peer-checked:after:-translate-x-full dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-purple-800"></div>
						<span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tampilkan di Slider</span>
					</label>
				</div>
			@endif
			<x-button.submit />
		</form>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/jquery.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-size.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-type.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-crop.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-exif-orientation.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-filter.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-preview.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-resize.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond.js') }}"></script>
	<script>
		FilePond.registerPlugin(
			FilePondPluginImagePreview,
			FilePondPluginImageCrop,
			FilePondPluginImageExifOrientation,
			FilePondPluginImageFilter,
			FilePondPluginImageResize,
			FilePondPluginFileValidateSize,
			FilePondPluginFileValidateType,
		)

		FilePond.create(document.querySelector(".image"), {
			files: [{
				source: "{{ $article->image }}",
				options: {
					type: 'local',
				},
			}],
			server: {
				load: (id, load) => {
					fetch("{{ route('filepond.load.file', ['filepath' => 'storage/articles/' . $article->image]) }}").then(res => res.blob()).then(load)
				}
			},
			credits: null,
			allowImagePreview: true,
			allowImageFilter: false,
			allowImageExifOrientation: false,
			allowImageCrop: false,
			acceptedFileTypes: [
				"image/png",
				"image/jpg",
				"image/jpeg",
				"image/webp"
			],
			maxFileSize: '10MB',
			fileValidateTypeDetectType: (source, type) =>
				new Promise((resolve, reject) => {
					resolve(type)
				}),
			storeAsFile: true,
		})
	</script>
	<script type="module">
		// Tiptap
		import {
			Editor
		} from 'https://esm.sh/@tiptap/core';
		import Placeholder from 'https://esm.sh/@tiptap/extension-placeholder';
		import StarterKit from 'https://esm.sh/@tiptap/starter-kit';
		import Paragraph from 'https://esm.sh/@tiptap/extension-paragraph';
		import Bold from 'https://esm.sh/@tiptap/extension-bold';
		import Underline from 'https://esm.sh/@tiptap/extension-underline';
		import Link from 'https://esm.sh/@tiptap/extension-link';
		import BulletList from 'https://esm.sh/@tiptap/extension-bullet-list';
		import OrderedList from 'https://esm.sh/@tiptap/extension-ordered-list';
		import ListItem from 'https://esm.sh/@tiptap/extension-list-item';
		import Blockquote from 'https://esm.sh/@tiptap/extension-blockquote';

		const editor = new Editor({
			element: document.querySelector('#hs-editor-tiptap [data-hs-editor-field]'),
			extensions: [
				Placeholder.configure({
					placeholder: 'Tulis artikel disini',
					emptyNodeClass: 'text-gray-800'
				}),
				StarterKit,
				Paragraph.configure({
					HTMLAttributes: {
						class: 'text-gray-800'
					}
				}),
				Bold.configure({
					HTMLAttributes: {
						class: 'font-bold'
					}
				}),
				Underline,
				Link.configure({
					HTMLAttributes: {
						class: 'inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline font-medium'
					}
				}),
				BulletList.configure({
					HTMLAttributes: {
						class: 'list-disc list-inside text-gray-800'
					}
				}),
				OrderedList.configure({
					HTMLAttributes: {
						class: 'list-decimal list-inside text-gray-800'
					}
				}),
				ListItem,
				Blockquote.configure({
					HTMLAttributes: {
						class: 'text-gray-800 sm:text-xl'
					}
				})
			],
			content: `{!! old('content') ?? $article->content !!}`,
			onUpdate({
				editor
			}) {
				document.querySelector('#input-content').value = editor.getHTML();
			}
		});
		const actions = [{
				id: '#hs-editor-tiptap [data-hs-editor-bold]',
				fn: () => editor.chain().focus().toggleBold().run()
			},
			{
				id: '#hs-editor-tiptap [data-hs-editor-italic]',
				fn: () => editor.chain().focus().toggleItalic().run()
			},
			{
				id: '#hs-editor-tiptap [data-hs-editor-underline]',
				fn: () => editor.chain().focus().toggleUnderline().run()
			},
			{
				id: '#hs-editor-tiptap [data-hs-editor-strike]',
				fn: () => editor.chain().focus().toggleStrike().run()
			},
			{
				id: '#hs-editor-tiptap [data-hs-editor-link]',
				fn: () => {
					const url = window.prompt('URL');
					editor.chain().focus().extendMarkRange('link').setLink({
						href: url
					}).run();
				}
			},
			{
				id: '#hs-editor-tiptap [data-hs-editor-ol]',
				fn: () => editor.chain().focus().toggleOrderedList().run()
			},
			{
				id: '#hs-editor-tiptap [data-hs-editor-ul]',
				fn: () => editor.chain().focus().toggleBulletList().run()
			},
			{
				id: '#hs-editor-tiptap [data-hs-editor-blockquote]',
				fn: () => editor.chain().focus().toggleBlockquote().run()
			},
			{
				id: '#hs-editor-tiptap [data-hs-editor-code]',
				fn: () => editor.chain().focus().toggleCode().run()
			}
		];

		actions.forEach(({
			id,
			fn
		}) => {
			const action = document.querySelector(id);

			if (action === null) return;

			action.addEventListener('click', fn);
		});
	</script>
@endpush
