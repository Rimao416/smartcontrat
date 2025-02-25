<?php
namespace App\Services;

use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    public function createArticle(array $data)
    {
        // Gérer le téléchargement d'image si présent
        if(isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = $data['image']->store('articles', 'public');
        }
        return Article::create($data);
    }

    public function updateArticle(Article $article, array $data)
    {
        if(isset($data['image']) && $data['image'] instanceof UploadedFile) {
            // Supprimer l'ancienne image si nécessaire
            if($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $data['image'] = $data['image']->store('articles', 'public');
        }
        $article->update($data);
        return $article;
    }

    public function deleteArticle(Article $article)
    {
        if($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();
    }
}
