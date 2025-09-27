@extends('layouts.authlayout')

@section('content')
    <div class="auth-container">
<form method="POST" action="{{route('register.store')}}">
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
    <input class="form-input" type="text" name="name" placeholder="Введите имя">
    <input class="form-input" type="email" name="email" placeholder="Введите email">
    <input class="form-input" type="password" name="password" placeholder="Введите пароль">
    </div>
    <button class="form-button" type="submit">Зарегистрироваться</button>
</form>
    </div>
@endsection
