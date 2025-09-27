<?php

namespace App\Http\Controllers;

use App\Models\favourites;
use App\Models\ItemInfo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
//use Illuminate\Support\Facades\Request;

class favouritesController extends Controller
{
    public function index(Request $request){
        $fav_info = Favourites::where('user_id', auth()->id())->get();
        //$item_id = Request::input('item_id');
        $item_id = $request->input('item_id');
        $response = Http::withToken('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwic3ViIjoiMSIsIm5iZiI6MTY3Mzc5NzgzOCwiZXhwIjo0ODI3Mzk3ODM4LCJpYXQiOjE2NzM3OTc4MzgsImp0aSI6IjJlamRwOG54a3A1djRnZWdhbWVyeWlkMW5ic24zZDhpZ2oyejgzem1vMDYzNjNoaXFkNWhwOTY1MHZwdWh4OXEybXBmd2hnbnUxNHR5cmp2In0.Ocw4CzkkuenkAOjkAR1RuFgLqix7VJ-8vWVS3KAJ1T3SgIWJG145xqG2qms99knu5azn_oaoeyMOXhyG_fuMQFGOju317GiS6pAXAFGOKvxcUCfdpFcEHO6TWGM8191-tlfV-0rAqCi62gprKyr-SrUG3nUJhv6XKegja_vYVujRVx0ouAaDvDKawiOssG5If_hXGhdhnmb3_7onnIc4hFsm4i9QVkWXe8GO6OsS999ZIX0ClNhTk2kKKTl2dDVIiKha_HB1aghm_LOYoRgb3i3B_DH4UO312rHYR5I4qO43c8x-TW7NwovItDSzhiCmcxZuUUeAUF3yFr5ovaR4fMj1LEy3y3V2piQDKPwmBOpI9S6OzWUIBJYcRYlT2HIrWCRc0YvM7AOGoxcH2Gf4ncqcF_M8fw7IMKf3pdnuxf1EbdEpzOapBD1Pw065em-U8PN4LVzw9lhIHx_Yj69qaFEx7Bhw3BCwsrx-o9hgg7T1TOV6kF11YfR99lIuj9z96XBLg5ipt-M_j7nHRoHWhM0Rc6uLIKPg0In0xYkybSfWG6v3Hs6kwgB7wkqpXpoVQltJvlqjtlf9Pp4zmkqlWQHx9as4xsgoTAQyCgaC0kisICNC58_g3QrJAfoFXW68x-OHlRKCAPqoR9V-0cVs-B83szaFmsEGegAttFLlDhE')->get("dapi.stalcraft.net/RU/auction/{$item_id}/lots");
        $data = $response->json();
        return view('favourites', compact('fav_info', 'data', 'item_id'));
    }

    public function addFavourite(Request $request){

        //$userId = $request->user()->id;
        $userId = Auth::id();
        //$item_name = ItemInfo::find('item_name');


        $request->validate([
            'user_id' => 'required',
            'item_id' => 'required',
            'item_name' => 'required'

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
            return view('/', compact('userId'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ошибка при добавлении записи: ' . $e->getMessage());
        }

    }

    public function removeFavourite(Request $request){
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
