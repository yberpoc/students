@extends('layout.app')

@section('title', 'Авторизация')

@section('content')
    <section class="wrapper">
        <div class="wrapper__title">
            <h1>Авторизация</h1>
        </div>
        <form class="wrapper__form" action="index.php?method=auth" method="post">
            <input class="wrapper__input" type="text" name="ALogin" placeholder="Логин">
            <input class="wrapper__input" type="password" name="APassword" placeholder="Пароль">
            <input class="wrapper__button" type="submit" name="login">
            <p class="message">  {{$message}}  </p>
        </form>
    </section>
@endsection