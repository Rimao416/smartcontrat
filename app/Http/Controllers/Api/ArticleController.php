<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Theme;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    // GET /api/articles
    public function index()
    {
        // $articles = Article::with('theme')->paginate(10);
        // return response()->json($articles);

        $articles = Article::with('theme')->get();

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $themes = Theme::all(); // Récupérer tous les thèmes pour le select
        return view('articles.create', compact('themes'));
    }

    // GET /api/articles/{id}
    public function show($id)
    {
        // $article = Article::with('theme')->findOrFail($id);
        // return response()->json($article);
        $article = Article::with('theme')->findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // POST /api/articles
    public function store(StoreArticleRequest $request)
    {
        $article = $this->articleService->createArticle($request->validated());
        return redirect()->route('articles.index')
            ->with('success', 'Enregistrement effectué avec succès !');
    }

    // PUT /api/articles/{id}
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article = $this->articleService->updateArticle($article, $request->validated());
        
        return redirect()->route('articles.index')
                         ->with('success', 'Modification effectuée avec succès !');
    }
    

    // DELETE /api/articles/{id}
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->articleService->deleteArticle($article);
        return redirect()->route('articles.index')
                         ->with('success', 'Article supprimé avec succès !');
    }
    public function edit($id)
{
    $article = Article::findOrFail($id);
    $themes = Theme::all();
    return view('articles.edit', compact('article', 'themes'));
}

}
