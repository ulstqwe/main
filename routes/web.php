<?php

use App\Http\Controllers\favouritesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItemInfoController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/*
Route::get('/', function () {
    $index.blade.php = DB::table('item_info')->get();
    return view('welcome', ['index.blade.php' => $index.blade.php]);
})->name('welcome');
*/

//основная страница с выбором предмета и отображением информации о нем
Route::get('/', [ItemController::class, 'index'])->name('welcome');
Route::get('/item_id={id}', [ItemController::class, 'index'])->name('item.api.data');

//страница избранного
Route::get('/favourites',[favouritesController::class, 'index'])
    ->middleware('auth')->name('favourites');
Route::get('/favourites/item_id={id}',[favouritesController::class, 'index'])->name('favourites.api.data');

//добавление/удаление из избранного
Route::post('/', [favouritesController::class, 'addFavourite'])->name('user-item.store');
Route::post('/favourites', [favouritesController::class, 'addFavourite'])->name('user-item.store');
Route::post('/favourites', [favouritesController::class, 'removeFavourite'])->name('user-item.remove');

//добавление/удаление предметов в базу данных
Route::resource('items', ItemInfoController::class)->middleware(IsAdminMiddleware::class);

//Route::get('/items', [ItemInfoController::class, 'index'])->name('items.index');
//Route::get('/items/{itemInfo}/edit', [ItemInfoController::class, 'edit'])->name('items.edit');



//авторизация/регистрация
Route::get('login', function (){
    return view('login');
})->name('login');

//защита от спама логина, 5 попыток - 1 минута
Route::post('login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.attempt');

Route::get('register', function (){
    return view('register');
})->name('register');

Route::post('register', [LoginController::class, 'register'])
    ->name('register.store');

Route::post('logout', function (){
    Auth::guard('web')->logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/');
})->name('logout');

//Route::get('/test', [ItemController::class, 'index'])->name('welcome');
//Route::get('/test/item_id={id}', [ItemController::class, 'index'])->name('item.api.data');

