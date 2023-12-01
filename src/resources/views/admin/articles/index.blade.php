@extends('admin.header')
@section('content')
<a href="{{ route('admin.articles.create') }}">記事を新規作成</a>
<table border="1">
    <thead>
        <tr>
            <th>サムネイル</th>
            <th>タイトル</th>
            <th>ステータス</th>
            <th>公開日</th>
            <th>作成日時</th>
            <th>更新日時</th>
            <th>編集</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>
                @if(empty($article->pictureUrl()))
                    未設定
                @else
                    <img src="{{ $article->pictureUrl() }}" style="width: 50px; height: 50px; object-fit: cover;">
                @endif
            </td>
            <td>
                @if(empty($article->title()))
                    未設定
                @else
                    {{ $article->title() }}
                @endif
            </td>
            <td>
                @if($article->articleStatusId() === 2)
                    <a href="{{ route('articles.show', ['articleId' => $article->articleId()]) }}">{{ $article->articleStatusName() }}</a>
                @else
                    {{ $article->articleStatusName() }}
                @endif
            </td>
            <td>{{ $article->publishedAt() }}</td>
            <td>{{ $article->createdAt() }}</td>
            <td>{{ $article->updatedAt() }}</td>
            <td>
                <a href="{{ route('articles.show', ['articleId' => $article->articleId()]) }}">編集</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
