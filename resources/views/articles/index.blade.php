<!DOCTYPE html>
<html>

<head>
    <!-- Local style sheet relative to this file -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div class="wrapper">
        <h1>Top 20 articles of 2023</h1>
        <a href="{{ route('articles.create') }}">
            <button class="button-3" role="button">Ajouter un article</button>
        </a>
    </div>
    <section class="articles">
        @foreach($articles as $article)
        <article>
            <div class="article-wrapper">
                <figure>
                    @if($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                    @else
                    <img src="https://placehold.co/600x400" alt="Image non disponible">
                    @endif
                </figure>
                <div class="article-body">
                    <h2>{{ $article->title }}</h2>
                    <p>
                        {{ Str::limit($article->description, 150, '...') }}
                    </p>
                    <a href="{{ route('articles.show', $article->id) }}" class="read-more">
                        published {{ \Carbon\Carbon::parse($article->date)->format('d/m/Y') }}
                        <span class="sr-only">about {{ $article->title }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <p>#{{ $article->theme->slug ?? 'coding' }}</p>
                </div>
            </div>
        </article>
        @endforeach
        <div class="pagination">
            {{ $articles->links() }}
        </div>
    </section>

</body>

</html>