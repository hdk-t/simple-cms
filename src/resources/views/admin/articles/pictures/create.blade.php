@extends('admin.header')
@section('content')
    <h1>STEP2</h1>
    <form method="post">
        @csrf
        <h2>サムネイルに設定する画像を選択してください</h2>
        <div style="display: flex; flex-wrap: wrap;">
            @foreach ($pictures->pictureEntities() as $picture)
                <div style="text-align: center; margin-right: 10px;">            
                    <label for="{{ 'picture' . $picture->pictureId() }}">
                        <img src="{{ $picture->path() }}" width="300">
                    </label>
                    <br>
                    <input id="{{ 'picture' . $picture->pictureId() }}" name="pictureId" type="radio" value="{{ $picture->pictureId() }}" />
                </div>
            @endforeach
        </div>
        <div>
            <b style="color: red;">{{ $errors->first('pictureId') }}</b>
        <div>
        <div>
            <a @if (!is_null($pictures->previousPageUrl())) href="{{ $pictures->previousPageUrl() }}" @endif>前へ</a>
            &nbsp;
            <a @if (!is_null($pictures->nextPageUrl())) href="{{ $pictures->nextPageUrl() }}" @endif>次へ</a>
        </div>
        <div>
            <button type="submit" formaction="{{ route('admin.articles.preview', ['articleId' => $articleId]) }}"
                formtarget="_blank">プレビューを見る</button>
            <button type="submit"
                formaction="{{ route('admin.articles.pictures.store', ['articleId' => $articleId, 'storeType' => 'draft']) }}">下書き保存する</button>
            <button type="submit"
                formaction="{{ route('admin.articles.pictures.store', ['articleId' => $articleId, 'storeType' => 'publish']) }}">記事を公開する</button>
        </div>
    </form>
@endsection
