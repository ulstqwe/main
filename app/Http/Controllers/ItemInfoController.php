<?php

namespace App\Http\Controllers;

use App\Models\ItemInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = ItemInfo::all();

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     */
    public function show(ItemInfo $itemInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /*
    public function edit(ItemInfo $itemInfo)
    {
        dd($itemInfo);
        return view('items.edit', compact('itemInfo'));
    }
    */
    public function edit($id)
    {
        $itemInfo = ItemInfo::findOrFail($id);
        return view('items.edit', compact('itemInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $itemInfo = ItemInfo::findOrFail($id);


        $request->validate([
            'item_name' => 'required',
            'item_id' => 'required',
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $itemInfo = ItemInfo::findOrFail($id);
        $itemInfo->delete();

        return redirect()->route('items.index');
    }
}
