<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['create']),
        ];
    }

    public function index()
    {
        $articles = Article::query()
            ->with('category')
            ->latest()
            ->paginate(6);

        return view('article.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $article->load(['category', 'user']);

        return view('article.show', compact('article'));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles()
            ->with('category')
            ->latest()
            ->paginate(6);

        return view('article.byCategory', compact('articles', 'category'));
    }

    public function create()
    {
        return view('article.create');
    }
}
