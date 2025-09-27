<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация & регистрация</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.6;
        }

        /* Контейнер формы */
        .auth-container {
            background: white;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 1rem;
        }

        /* Заголовок */
        .auth-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            font-weight: 300;
            font-size: 1.8rem;
        }

        /* Форма */
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        /* Группа полей ввода */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        /* Метки */
        .form-label {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }

        /* Поля ввода */
        .form-input {
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.1);
        }

        /* Кнопка */
        .form-button {
            background: #007bff;
            color: white;
            padding: 0.8rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 0.5rem;
        }

        .form-button:hover {
            background: #0056b3;
        }

        /* Ссылка */
        .auth-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .auth-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-link a:hover {
            text-decoration: underline;
        }

        /* Сообщения об ошибках */
        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.3rem;
        }

        /* Адаптивность */
        @media (max-width: 480px) {
            .auth-container {
                padding: 2rem 1.5rem;
                margin: 0.5rem;
            }

            .auth-title {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
<main>
    @yield('content')
</main>
</body>
</html>
