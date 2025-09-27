<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        /* Шапка */
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .item-image{
            display: block;
            width: 30px;
            height: 30px;
            float: left;
            margin-left: auto;
            margin-right: auto;
        }
        .item-form {
            max-width: 500px;
            margin: 0 auto;
            padding: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.2s;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .file-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px dashed #d1d5db;
            border-radius: 0.375rem;
            background: #f9fafb;
        }

        .file-hint {
            display: block;
            margin-top: 0.25rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .current-image {
            margin-bottom: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 0.375rem;
            text-align: center;
        }

        .image-preview {
            max-width: 100px;
            max-height: 100px;
            border-radius: 0.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .filename {
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #4b5563;
        }

        .form-actions {
            margin-top: 2rem;
            text-align: center;
        }

        .submit-btn {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.375rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .submit-btn:hover {
            background: #2563eb;
        }

        .submit-btn:active {
            transform: translateY(1px);
        }

        .nav-buttons {
            display: flex;
            gap: 1rem;
        }

        .nav-btn {
            background: none;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .nav-btn-additem {
            background: #34495e;
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .nav-btn-additem:hover {
            background-color: #34495e;
        }

        .nav-btn:hover {
            background-color: #34495e;
        }

        .login-btn {
            background-color: #3498db;
            border: none;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color: #2980b9;
        }

        /* Основное содержимое */
        .container {
            display: flex;
            min-height: calc(100vh - 80px);
        }

        /* Боковое меню */
        .sidebar {
            width: 250px;
            background-color: white;
            padding: 2rem;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .category-list {
            list-style: none;
        }

        .category-item {
            padding: 0.8rem 1rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .category-item:hover {
            background-color: #ecf0f1;
        }

        .category-item.active {
            background-color: #3498db;
            color: white;
        }

        /* Центральная область */
        .content {
            flex: 1;
            padding: 2rem;
            background-color: white;
            margin: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .item-list {
            list-style: none;
        }

        .list-item {
            padding: 1rem;
            border-bottom: 1px solid #ecf0f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .item-title {
            font-weight: bold;
        }

        .item-date {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        table {
            width: 100%;
            border-top: 7px solid rgb(0, 0, 0);
            border-collapse: collapse;
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid #000000;
        }
        .form-button {
            background: #007bff;
            color: white;
            padding: 0.8rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }
        td {
            text-align: left;
            padding: 10px;
            border: 3px solid rgb(0, 0, 0);
        }
        .auth{
            display: flex;
            padding: 0.5rem 1rem;
            margin-right: 10px;
            margin-left: auto;
            gap: 1rem;
        }
    </style>
</head>
<body>
<!-- Шапка -->
<header>
    <div class="nav-buttons">
        <a href="/" class="nav-btn">Главная</a>
        <a href="/about" class="nav-btn">О проекте</a>


        @auth
            <a href="/favourites" class="nav-btn">Избранное</a>
            @if(auth()->user()->is_admin)
                <a href="/items" class="nav-btn">Редактировать предметы</a>
            @endif

        @endauth
    </div>
    <div class="auth">
        @if (Route::has('login'))
            @auth
                <h1>{{Auth::user()->name}}</h1>
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="nav-btn">Выйти</button>
                </form>
            @else
                <a href="/login" class="nav-btn">Вход</a>
                @if (Route::has('register'))
                    <a href="/register" class="nav-btn">Регистрация</a>
                @endif
            @endauth
        @endif


    </div>

</header>

@yield('content')

</body>
</html>
