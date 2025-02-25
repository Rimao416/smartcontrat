<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un article</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Vos styles ici */
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un article</h1>
        @include('articles._form', [
            'action' => route('articles.store'),
            'method' => 'POST',
            'buttonText' => 'Ajouter',
            'themes' => $themes
        ])
        <a href="{{ route('articles.index') }}" class="back-link">← Retour aux articles</a>
    </div>
</body>
</html>
