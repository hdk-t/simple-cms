@extends('header')
@section('content')
    <h1>{{ $article->title() }}</h1>
    <div>
        {{ $article->publishedAt() }}
    </div>
    <div>
        @foreach ($article->tags() as $tag)
            <span>{{ " #$tag" }}</span>
        @endforeach
    </div>
    <img src="{{ $article->pictureUrl() }}" style="height: 400px;">
    <div>
        {!! $article->body() !!}
    </div>
@endsection