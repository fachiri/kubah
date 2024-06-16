<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->take(6)->get();
        $carousels = Article::where('is_featured', 1)
                    ->select('title', 'image', 'slug')
                    ->take(6)
                    ->get();

        return view('pages.home.index', compact('articles', 'carousels'));
    }
}
