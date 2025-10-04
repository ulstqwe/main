<?php

namespace App\Http\Controllers;

use App\Models\favourites;
use App\Models\ItemInfo;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;


class favouritesController extends Controller
{
    public function index(Request $request): View
    {
        $fav_info = Favourites::where('user_id', auth()->id())->get();
        $item_id = $request->input('item_id');
        $response = Http::withToken(config('services.stalcraft.token'))
            ->get(config('services.stalcraft.base_url') . "/RU/auction/{$item_id}/lots");
        $data = $response->json();
        return view('favourites', compact('fav_info', 'data', 'item_id'));
    }

    public function addFavourite(Request $request) : RedirectResponse|View
    {
        $userId = Auth::id();
        //$item_name = ItemInfo::find('item_name');


        $request->validate([
            'user_id' => 'required|integer',
            'item_id' => 'required|string',
            'item_name' => 'required|string',

        ]);

        //$favouriteItem = favourites::create($credentials);

        try {
            // Проверяем, нет ли уже такой записи
            $existingRecord = Favourites::where('user_id', $request->user_id)
                ->where('item_id', $request->item_id)
                ->first();

            if ($existingRecord) {
                return redirect()->back()->with('error', 'Запись уже существует');
            }

            // Создаем новую запись
            Favourites::create([
                'user_id' => $request->user_id,
                'item_id' => $request->item_id,
                'item_name' => $request->item_name,

            ]);

            //return redirect()->back()->with('success', 'Запись успешно добавлена');
            return view('welcome', compact('userId'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ошибка при добавлении записи: ' . $e->getMessage());
        }

    }

    public function removeFavourite(Request $request): RedirectResponse|View
    {
        $userId = Auth::id();

        // Поиск записи
        $favorite = favourites::where('user_id', $userId)
            ->where('item_id', request('item_id'))
            ->first();

        if (!$favorite) {
            return redirect()->back()
                ->with('error', 'Запись не найдена');
        }

        // Удаление
        $favorite->delete();

        return redirect()->back()
            ->with('success', 'Удалено из избранного');
    }
}
