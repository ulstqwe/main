<?php

namespace App\Http\Controllers;

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
     * @param Request $request Входящий HTTP запрос, в который входит email пользователя и пароль
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Пользователь не найден',
        ])->onlyInput('email');
    }

    /**
     * Регистрация пользователя
     * @param Request $request Входящий HTTP запрос, в который входит имя пользователя, email и пароль
     * @return RedirectResponse
     */
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::create($credentials);
        Auth::login($user);
        return redirect()->intended('/');

    }

}
