@extends('layouts.layout')

@section('main')
                    <section class="login">
                        <h1>Авторизация</h1>
                        <form action="{{ route('register.store') }}" method="post" class="auth-form block-medium">
                            @csrf
                            <div class="input">
                                <h3>Логин</h3>
                                <input type="text" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="input">
                                <h3>Емейл</h3>
                                <input type="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="input">
                                <h3>Пароль</h3>
                                <input type="password" name="password" required>
                            </div>
                            <div class="input">
                                <h3>Повторите Пароль</h3>
                                <input type="password" name="password_confirmation" required>
                            </div>
                            <div class="submit">
                                <input type="submit" value="Регистрация">
                                <a href="">Есть аккаунт?</a>
                            </div>
                        </form>
                    </section>
@endsection