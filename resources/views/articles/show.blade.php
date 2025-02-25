<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - Détails</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            width: 700px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
            color: #333;
            font-size: 32px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .article-details {
            margin: 20px 0;
        }
        .article-details p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
            margin: 10px 0;
        }
        .article-meta {
            font-size: 16px;
            color: #777;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #0056b3;
        }
        .article-image {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .btn-edit {
            background-color: #28a745;
        }
        .btn-edit:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        /* Formulaire de suppression caché */
        .delete-form {
            display: inline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>{{ $article->title }}</h1>

        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="article-image">
        @endif

        <div class="article-details">
            <p>{{ $article->description }}</p>
        </div>

        <div class="article-meta">
            <p><strong>Thème :</strong> {{ $article->theme->label ?? 'Non défini' }}</p>
            <p><strong>Date de publication :</strong> {{ \Carbon\Carbon::parse($article->date)->format('d/m/Y') }}</p>
        </div>

        <div class="btn-container">
            <!-- Bouton Modifier -->
            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-edit">Modifier</a>
            
            <!-- Bouton Supprimer -->
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Supprimer</button>
            </form>
        </div>

        <a href="{{ route('articles.index') }}" class="back-link">← Retour aux articles</a>
    </div>
    
</body>
</html>
