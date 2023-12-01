<form method="post" action="{{ route('admin.auth.login') }}">
    @csrf
    <div>
        <label for="pass">パスワードを入力してください</label>
    </div>
    <input id="pass" type="password" name="password" />
    <button type="submit">ログイン</button>
    <div>
        <b style="color: red;">{{ $errors->first('password') }}</b>
    <div>
</form>