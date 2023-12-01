@extends('admin.header')
@section('content')
    <h1>STEP1</h1>
    <form method="post">
        @csrf
        <div>
            <label for="title">タイトル</label>
            <br>
            <input type="text" name="title" id="title" value="{{ old('title') ?? ''}}"/>
            <div>
                <b style="color: red;">{{ $errors->first('title') }}</b>
            <div>
        </div>
        <br>
        <div>
            <label>タグ設定(複数設定可能)</label>
            <div>
                @foreach($tags as $tag)
                    <input id="{{ 'tag'.$tag->tagId() }}" name="tagIds[]" type="checkbox" value="{{ $tag->tagId() }}" @if(in_array($tag->tagId(), old('tagIds') ?? [])) checked @endif/>
                    <label for="{{ 'tag'.$tag->tagId() }}">{{ $tag->name() }}</label>
                @endforeach
            </div>
        </div>
        <br>
        <div>
            <label for="body">記事本文(マークダウン記法で記述してください)</label>
            <br>
            <textarea name="body" id="body" rows="30" cols="200">{{ old('body') ?? ''}}</textarea>
            <div>
                <b style="color: red;">{{ $errors->first('body') }}</b>
            <div>
        </div>
        <div>
            <button type="submit" formaction="{{ route('admin.articles.preview') }}" formtarget="_blank">プレビューを見る</button>
            <button type="submit" formaction="{{ route('admin.articles.store', ['storeType' => 'draft']) }}">下書き保存する</button>
            <button type="submit" formaction="{{ route('admin.articles.store', ['storeType' => 'next']) }}">次に進む</button>
        </div>
    </form>
@endsection
