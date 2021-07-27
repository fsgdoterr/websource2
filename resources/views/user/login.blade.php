@extends('layouts.layout')

@section('main')
<section class="login">
    <h1>Авторизация</h1>
    <form action="{{ route('login.store') }}" method="post" class="auth-form block-medium">
        @csrf
        <div class="input">
            <h3>Емейл</h3>
            <input type="text" name="email" required>
        </div>
        <div class="input">
            <h3>Пароль</h3>
            <input type="password" name="password" required>
        </div>
        <div class="submit">
            <input type="submit" value="ВОЙТИ">
            <a href="">Регистрация</a>
        </div>
    </form>
</section>
@endsection