@extends('layouts.app')

@section('content')
    <!-- Основное содержимое -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('items.update', $itemInfo->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!--{{ $itemInfo->item_name }}-->

                        <div>
                            <div class="form-group">
                                <label for="name" class="form-label">Название:</label>
                                <input type="text" name="item_name" id="item_name" class="form-input" value="{{ $itemInfo->item_name }}">
                            </div>

                            <div class="form-group">
                                <label for="name" class="form-label">id предмета:</label>
                                <input type="text" name="item_id" id="item_id" class="form-input" value="{{ $itemInfo->item_id }}">
                            </div>

                            <div>
                                <div class="form-group">
                                    <label for="item_icon" class="form-label">Иконка предмета:</label>
                                </div>
                                <!-- Текущее изображение -->
                                @if($itemInfo->item_icon)
                                    <div class="current-image">
                                        <p>Текущая иконка:</p>
                                        <img src="{{ asset('storage/items/' . $itemInfo->item_icon) }}" alt="Current icon" style="max-width: 100px;">
                                        <p class="filename">{{ $itemInfo->item_icon }}</p>
                                    </div>
                                @endif

                                <input type="file" name="item_icon" id="item_icon" accept="image/*" class="file-input">
                                <small class="file-hint">Оставьте пустым, чтобы сохранить текущее изображение</small>
                            </div>

                            <div>
                        </div>
                        <div>
                            <button type="submit" class="submit-btn">
                                Сохранить
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
