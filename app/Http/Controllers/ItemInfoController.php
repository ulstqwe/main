<?php

namespace App\Http\Controllers;

use App\Models\ItemInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Контроллер для создания/удаления/редактирования предметов в базе данных
 * @package App\Http\Controllers
 */
class ItemInfoController extends Controller
{
    /**
     * Отображение данных из базы
     * @return View
     */
    public function index(): View
    {
        $items = ItemInfo::all();

        return view('items.index', compact('items'));
    }

    /**
     * Отображение формы для добавления предмета
     * @return View
     */
    public function create(): View
    {
        return view('items.create');
    }

    /**
     * Запись созданного предмета в базу данных
     * @param Request $request Входящий HTTP запрос, в который входит название предмета, id предмета и его изображение
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_id' => 'required|string',
            'item_icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // максимум 2MB
        ]);

        // Сохраняем изображение
        if ($request->hasFile('item_icon')) {
            $file = $request->file('item_icon');
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/items', $filename);
            $data['item_icon'] = $filename;
        }

        ItemInfo::create($data);

        return redirect()->route('items.index');
    }


    public function show(ItemInfo $itemInfo)
    {
        //
    }


    /**
     * Редактирование уже созданного предмета
     * @param int $id id предмета
     * @return View
     */
    public function edit(int $id): View
    {
        $itemInfo = ItemInfo::findOrFail($id);
        return view('items.edit', compact('itemInfo'));
    }


    /**
     * Обновление данных о предмете
     * @param Request $request Входящий HTTP запрос, в который входит название предмета, id предмета и его изображение
     * @param int $id id предмета
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {

        $itemInfo = ItemInfo::findOrFail($id);


        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_id' => 'required|string',
            'item_icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'item_name' => $request->input('item_name'),
            'item_id' => $request->input('item_id'),
        ];

        // Обработка загрузки изображения
        if ($request->hasFile('item_icon')) {
            // Удаляем старое изображение, если оно есть
            if ($itemInfo->item_icon) {
                Storage::delete('public/items/' . $itemInfo->item_icon);
            }

            // Сохраняем новое изображение
            $file = $request->file('item_icon');
            $filename = $file->getClientOriginalName();

            // Сохраняем файл в storage/app/public/items
            $file->storeAs('public/items', $filename);

            $data['item_icon'] = $filename;
        }

        $itemInfo->update($data);

        return redirect()->route('items.index', );
    }


    /**
     * Удаление записи о предмете из базы данных
     * @param int $id id предмета
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $itemInfo = ItemInfo::findOrFail($id);
        $itemInfo->delete();

        return redirect()->route('items.index');
    }
}
