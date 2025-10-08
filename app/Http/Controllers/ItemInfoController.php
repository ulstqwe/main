<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemEditRequest;
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
     * @param ItemEditRequest $request Входящий HTTP запрос, в который входит название предмета, id предмета и его изображение
     * @return RedirectResponse
     */
    public function store(ItemEditRequest $request): RedirectResponse
    {
        $data = $request->validated();

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
     * @param ItemInfo $itemInfo id предмета
     * @return View
     */
    //public function edit(int $id): View
    public function edit(ItemInfo $itemInfo): View
    {
        //$itemInfo = ItemInfo::findOrFail($id);
        return view('items.edit', compact('itemInfo'));
    }


    /**
     * Обновление данных о предмете
     * @param ItemEditRequest $request Входящий HTTP запрос, в который входит название предмета, id предмета и его изображение
     * @param ItemInfo $itemInfo id предмета
     * @return RedirectResponse
     */
    //public function update(ItemEditRequest $request, int $id): RedirectResponse
    public function update(ItemEditRequest $request, ItemInfo $itemInfo): RedirectResponse
    {

        //$itemInfo = ItemInfo::findOrFail($id);

        $data = $request->validated();

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
     * @param ItemInfo $itemInfo id предмета
     * @return RedirectResponse
     */
    //public function destroy(int $id): RedirectResponse
    public function destroy(ItemInfo $itemInfo): RedirectResponse
    {
        //$itemInfo = ItemInfo::findOrFail($id);

        $itemInfo->delete();

        return redirect()->route('items.index')->with('success', 'Предмет успешно удален');
    }
}
