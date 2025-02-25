<!-- resources/views/articles/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Modifier l\'article - ' . $article->title)

@section('content')
    <h1>Modifier l'article</h1>
    @include('articles._form', [
        'article' => $article,
        'action' => route('articles.update', $article->id),
        'method' => 'PUT',
        'buttonText' => 'Enregistrer les modifications',
        'themes' => $themes
    ])
    <a href="{{ route('articles.index') }}" class="back-link">← Retour aux articles</a>
@endsection
