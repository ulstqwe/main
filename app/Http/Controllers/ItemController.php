<?php

namespace App\Http\Controllers;

use App\Models\favourites;
use App\Models\ItemInfo;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;
use Illuminate\View\View;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;


/**
 * Контроллер для работы с отображением предметов пользователю
 * @package App\Http\Controllers
 */
class ItemController extends Controller
{

    /**
     * Отображение информации и предмете на главной странице
     * @param Request $request Входящий HTTP запрос, в который входит id предмета
     * @return View
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function index(Request $request): View
    {
        //присваиваем значение, которое идет при выборе предмета
        $item_id = $request->input('item_id');
        $item_info = ItemInfo::all();
        $response = Http::withToken(config('services.stalcraft.token'))
            ->get(config('services.stalcraft.base_url') . "/RU/auction/{$item_id}/lots");
        $data = $response->json();
        return view('welcome', compact('item_info', 'data', 'item_id'));
    }

}
