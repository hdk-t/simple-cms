@extends('header')
@section('content')
    @foreach ($articles as $article)
        <div style="margin-top: 50px;">
            <div>
                <img src="{{ $article->pictureUrl() }}" style="width: 200px; height: 200px; object-fit: cover;">
            </div>
            <div>
                <a href="{{ route('articles.show', [ 'articleId' => $article->articleId() ]) }}">{{ $article->title() }}</a>
            </div>
            <div>
                {{ $article->publishedAt() }}
            </div>
            @foreach ($article->tags() as $tag)
                <div>{{ "#$tag" }}</div>
            @endforeach
        </div>
    @endforeach
@endsection