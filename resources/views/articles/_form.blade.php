@php
    // Définir des valeurs par défaut si elles n'existent pas
    $article = $article ?? null;
    $action = $action ?? route('articles.store');
    $method = $method ?? 'POST';
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <label for="title">Titre</label>
    <input type="text" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" required>

    <label for="theme_id">Thème</label>
    <select id="theme_id" name="theme_id" required>
        @foreach($themes as $theme)
            <option value="{{ $theme->id }}" {{ (old('theme_id', $article->theme_id ?? '') == $theme->id) ? 'selected' : '' }}>
                {{ $theme->label }}
            </option>
        @endforeach
    </select>

    <label for="description">Description</label>
    <textarea id="description" name="description" rows="5" required>{{ old('description', $article->description ?? '') }}</textarea>

    <label for="image">Image</label>
    <input type="file" id="image" name="image">

    <label for="date">Date de publication</label>
    <input type="date" id="date" name="date" value="{{ old('date', isset($article->date) ? \Carbon\Carbon::parse($article->date)->format('Y-m-d') : '') }}" required>

    <button type="submit">{{ $buttonText ?? 'Enregistrer' }}</button>
</form>
