<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
}
