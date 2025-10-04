<?php

namespace App\Http\Controllers;

use App\Models\favourites;
use App\Models\ItemInfo;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;
use Illuminate\View\View;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;


class ItemController extends Controller
{
    public function index(Request $request): View
    {
        //присваиваем значение которое идет при выборе предмета
        $item_id = $request->input('item_id');
        $item_info = ItemInfo::all();
        $response = Http::withToken(config('services.stalcraft.token'))
            ->get(config('services.stalcraft.base_url') . "/RU/auction/{$item_id}/lots");
        $data = $response->json();
        return view('welcome', compact('item_info', 'data', 'item_id'));
    }

}
