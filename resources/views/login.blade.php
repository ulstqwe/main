@extends('layouts.authlayout')

@section('content')
    <div class="auth-container">
<form class="auth-form" method="POST" action="{{route('login.attempt')}}">
    @csrf
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
    <input class="form-input" type="email" name='email' placeholder="Введите ваш email">
    <input class="form-input" type="password" name="password" placeholder="Введите ваш пароль">
    </div>
    <button class="form-button" type="submit">Войти</button>
</form>
    </div>
@endsection
