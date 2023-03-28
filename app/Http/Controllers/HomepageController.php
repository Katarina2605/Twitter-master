<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

class HomepageController extends Controller
{
    public function index()
    {
        $articles = Article::where('published_at', '<', now())
            ->withCount('comments')
            ->withCount('likes')
            ->orderByDesc('published_at')
            ->take(4)
            ->get()
        ;

        return view('homepage.index', [
            'articles' => $articles,
        ]);
    }

    public function members(){
        $members = User::paginate(12);

        return view('members.index', [
            'members' => $members,
        ]);
    }
}
