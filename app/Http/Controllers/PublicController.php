<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    public function homepage()
    {
        $articles = collect();

        if (Schema::hasTable('articles')) {
            $articles = Article::query()
                ->with('category')
                ->latest()
                ->take(6)
                ->get();
        }

        return view('welcome', compact('articles'));
    }
}
