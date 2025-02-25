@php
    $article = $article ?? null;
    $action = $action ?? route('articles.store');
    $method = $method ?? 'POST';
@endphp

{{-- Affichage des messages flash --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="theme_id" class="form-label">Thème</label>
        <select id="theme_id" name="theme_id" class="form-select">
            @foreach($themes as $theme)
                <option value="{{ $theme->id }}" {{ (old('theme_id', $article->theme_id ?? '') == $theme->id) ? 'selected' : '' }}>
                    {{ $theme->label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="5" class="form-control">{{ old('description', $article->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" id="image" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date de publication</label>
        <input type="date" id="date" name="date" value="{{ old('date', isset($article->date) ? \Carbon\Carbon::parse($article->date)->format('Y-m-d') : '') }}" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">{{ $buttonText ?? 'Enregistrer' }}</button>
</form>
