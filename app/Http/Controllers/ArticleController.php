<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::where('published_at', '<', now())
            ->where('body', 'LIKE', '%' . $request->query('search') . '%')
            ->orWhere('title', 'LIKE', '%' . $request->query('search') . '%')
            ->orWhereHas('user', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->query('search') . '%');
            })
            ->withCount('comments')
            ->withCount('likes')
            ->orderByDesc('published_at')
            ->paginate(12);

        return view('articles.index', [
            'articles' => $articles,
        ]);
    }

    public function show($id)
    {
        // On récupère l'article et on renvoie une erreur 404 si l'article n'existe pas
        $article = Article::withCount('likes')->findOrFail($id);
        // On récupère les commentaires de l'article, avec les utilisateurs associés (via la relation)
        // On les trie par date de création (le plus ancien en premier)
        $comments = $article
            ->comments()
            ->with('user')
            ->orderBy('created_at')
            ->get();
        $liked=false;
        if (Auth::check()) {
            $liked=$article->likes()->where('user_id', Auth::id())->exists();
        }

        // On renvoie la vue avec les données
        return view('articles.show', [
            'article' => $article,
            'comments' => $comments,
            'liked' => $liked,
        ]);
    }

    public function addComment(Request $request, Article $article)
    {
        // On vérifie que l'utilisateur est authentifié
        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        // On crée le commentaire
        $comment = $article->comments()->make();
        // On remplit les données
        $comment->body = $request->input('body');
        $comment->user_id = auth()->user()->id;
        // On sauvegarde le commentaire
        $comment->save();

        // On redirige vers la page de l'article
        return redirect()->back();
    }

    public function deleteComment(Article $article, Comment $comment)
    {
        // On vérifie que l'utilisateur à le droit de supprimer le commentaire
        $this->authorize('delete', $comment);

        // On supprime le commentaire
        $comment->delete();

        // On redirige vers la page de l'article
        return redirect()->back();
    }

    public function like($articleId)
    {
        if (!Auth::check()) {
            return redirect()->back();
        }
        $user = Auth::user();
        $article = Article::findOrFail($articleId);

        if ($article->likes()->where('user_id', $user->id)->exists()) {
            $article->likes()->where('user_id', $user->id)->get()->first()->delete();
        } else {
            $like = new Like();
            $like->user_id = $user->id;
            $article->likes()->save($like);
        }

        return redirect()->back()->with('success', 'Article aimé avec succès.');
    }

}
