<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Article::class);

        $articleQuery = Article::query();

        if (auth()->user()->isVolunteer()) {
            $articleQuery->where('user_id', auth()->user()->id);
        }

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $articleQuery->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('content', 'like', '%' . $searchTerm . '%');
            });
        }

        $articles = $articleQuery->latest()->paginate(5);

        return view('pages.articles.index', compact('articles'));
    }

    public function create()
    {
        Gate::authorize('create', Article::class);

        return view('pages.articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        Gate::authorize('create', Article::class);

        try {
            $data = $request->validated();
            $image = basename($request->file('image')->store('public/articles'));
            $data['image'] = $image;
            $data['user_id'] = auth()->user()->id;

            $article = Article::create($data);

            return redirect()->route('articles.show', $article->slug)->with('success', 'Artikel Anda berhasil dibuat.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.'])->withInput();
        }
    }

    public function show(Article $article)
    {
        Gate::authorize('view', $article);

        return view('pages.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        Gate::authorize('update', $article);

        return view('pages.articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        Gate::authorize('update', $article);

        try {
            $article->title = $request->title;
            $article->content = $request->content;
            if (auth()->user()->isAdmin()) $article->is_featured = $request->is_featured ? 1 : 0;
            if ($request->hasFile('image')) {
                Storage::delete("public/articles/{$article->image}");
                $article->image = basename($request->file('image')->store('public/articles'));
            }
            $article->update();

            return redirect()->route('articles.show', $article->slug)->with('success', 'Artikel berhasil diedit.');
        } catch (\Throwable $th) {
            logger()->error($th->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan.'])->withInput();
        }
    }
}
