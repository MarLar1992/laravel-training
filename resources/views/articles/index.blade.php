@extends("layouts.app")
@section("content")
<div class="container">

    {{ $articles->links() }}
    @if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
    @endif

    @foreach($articles as $article)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <div class="card-subtitle mb-2 text-muted small">
                {{ $article->created_at->diffForHumans() }}
            </div>
            <p class="card-text">{{ $article->body }}</p>
            <a class="card-link" href="{{ url("/articles/detail/$article->id") }}">
                View Detail &raquo;
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection

<!-- <!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Article List</title>
</head>

<body>
    <h1>Article List</h1>
    <?php foreach ($articles as $article) : ?>
        <li><?php echo $article['title'] ?></li>
    <?php endforeach ?>

</body>

</html> -->