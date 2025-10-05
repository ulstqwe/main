<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Контроллер для авторизации/регистрации пользователя
 * @package App\Http\Controllers
 */
class LoginController extends Controller
{

    /**
     * Авторизация пользователя
     * @param LoginRequest $request Входящий HTTP запрос, в который входит email пользователя и пароль
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated())) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Пользователь не найден',
        ])->onlyInput('email');
    }

    /**
     * Регистрация пользователя
     * @param RegisterRequest $request Входящий HTTP запрос, в который входит имя пользователя, email и пароль
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());
        Auth::login($user);
        return redirect()->intended('/');

    }

}
