@extends('layouts.app')

@section('content')
<!-- Основное содержимое -->
<div class="container">
    <!-- Боковое меню категорий -->
    <aside class="sidebar">
        <ul><img class="item-image" src="{{asset('images/star.png')}}"/><li class="category-item">ПИДАРАСКА</li></ul>
        <h3>Популярные предметы</h3><br>
        <ul class="category-list">
            <!-- Вывод списка предметов из базы данных -->
            @foreach($item_info as $item)
                <img class="item-image" src="{{asset("images/$item->item_icon")}}"/>
                <li class="category-item">
                    <a href="/?item_id={{ $item->item_id }}"
                       class="text-gray-600 hover:text-gray-800">
                        {{ $item->item_name }}
                    </a>
                </li>

            @endforeach

        </ul>
    </aside>



    <!-- Центральная область с контентом -->
    <main class="content">
        <h2>Список лотов</h2>
        <ul class="item-list">


            @foreach($data['lots'] as $item)
                <li class="list-item">
                    @foreach($item as $value)

                        {{ json_encode($value) }}

                    @endforeach
                </li>
            @endforeach


        </ul>
    </main>
</div>
@endsection
