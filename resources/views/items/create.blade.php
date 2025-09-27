@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="content" >
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                                <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div>
                                        <div class="form-group">
                                            <label for="name" class="form-label">Название:</label>
                                            <input type="text" name="item_name" id="item_name" class="form-input">
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="form-label">id предмета:</label>
                                            <input type="text" name="item_id" id="item_id" class="form-input">
                                        </div>

                                        <div class="form-group">
                                            <label for="item_icon" class="form-label">Иконка предмета:</label>
                                            <input type="file" class="file-input" name="item_icon" id="item_icon" accept="image/*" required>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="submit-btn">
                                            Добавить
                                        </button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
