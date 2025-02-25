<!-- resources/views/articles/create.blade.php -->
@extends('layouts.app')

@section('title', 'Ajouter un article')

@section('content')
    <h1>Ajouter un article</h1>
    @include('articles._form', [
        'action' => route('articles.store'),
        'method' => 'POST',
        'buttonText' => 'Ajouter',
        'themes' => $themes
    ])
    <a href="{{ route('articles.index') }}" class="back-link">← Retour aux articles</a>
@endsection
