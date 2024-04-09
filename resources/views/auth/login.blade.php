@extends('layouts.all')

@php
    $title = "Авторизия";
    $description = "Страница авторизации";
@endphp

@section('title', $title)
@section('description', $description)

@section('main')

<section class="section">
    <div class="container is-fullhd">

        <form action="{{route('login_do')}}" method="post" class="box start-form">
            @csrf

            <header>

            </header>

            <div class="field">
              <label class="label">E-mail</label>
              <div class="control">
                <input name="email" class="input" type="email" placeholder="e.g. alex@example.com">
              </div>

              @error('email')
                <p class="error">{{$message}}</p>
              @enderror
            </div>

            <div class="field">
              <label class="label">Пароль</label>
              <div class="control">
                <input name="password" class="input" type="password" placeholder="********">
              </div>

              @error('password')
                  <p class="error">{{$message}}</p>
              @enderror
            </div>

            <footer>
                <button type="submit" class="button ">Войти</button>
            </footer>

        </form>
    </div>
</section>

@endsection

