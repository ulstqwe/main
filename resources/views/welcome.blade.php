@extends('layouts.app')

@section('content')
<!-- Основное содержимое -->
<div class="container">
    <!-- Боковое меню категорий -->
    <aside class="sidebar">
        <h3>Популярные предметы</h3><br>
        <ul class="category-list">
            <!-- Вывод списка предметов из базы данных -->
            @foreach($item_info as $item)
                <img class="item-image" src="{{asset("storage/items/$item->item_icon")}}"/>
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
    <main class="content" >
        @php
            //$isFavorite = auth()->user()->favoriteItems->contains(request('item_id'));
            //$favouritesItems = auth()->user()->favouritesItems($item->id);
            /*
            $exists = App\Models\favourites::where('user_id', auth()->id())
                ->where('item_id', request('item_id'))
                ->exists();
            */
            $currentItemId = request('item_id');
            $exists = App\Models\favourites::where('user_id', auth()->id())
                ->where('item_id', $currentItemId)
                ->exists();

            // Получаем информацию о текущем предмете
            $currentItem = $item_info->firstWhere('item_id', $currentItemId);
        @endphp

        @if($exists)
        <form method="POST" action="{{route('user-item.remove')}}">
            @csrf
            @auth
                @if(is_array($data) && array_key_exists('lots', $data))
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    <input type="hidden" name="item_id" value="{{ $currentItemId }}">
                    <input type="hidden" name="item_name" value="{{ $currentItem->item_name }}">


                    <button class="form-button" type="submit">Убрать из избранного&#11088;</button>
                @endif
            @endauth
        </form>
        @else
        <form method="POST" action="{{ route('user-item.store') }}">
            @csrf
            @auth
                @if(is_array($data) && array_key_exists('lots', $data))
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    <input type="hidden" name="item_id" value="{{ $currentItemId }}">
                    <input type="hidden" name="item_name" value="{{ $currentItem->item_name }}">
                    <button class="form-button" type="submit">Добавить в избранное&#11088;</button>
                @endif
            @endauth
        </form>
        @endif
        <h2>Список лотов</h2>
        <table>
            @if(is_array($data) && array_key_exists('lots', $data))
                <tr>
                    <td>id предмета</td>
                    <td>Кол-во предметов</td>
                    <td>Стартовая цена</td>
                    <td>Цена выкупа</td>
                    <td>Объявление было создано</td>
                </tr>
                @foreach($data['lots'] as $item)
                            <tr>
                                <td>{{ $item['itemId'] }}</td>
                                <td>{{ $item['amount'] }}</td>
                                <td>{{ number_format($item['startPrice'], 0, ',', ' ') }} ₽</td>
                                <td>{{ number_format($item['buyoutPrice'], 0, ',', ' ') }} ₽</td>
                                <td>{{ \Carbon\Carbon::parse($item['endTime'])->format('d.m.Y H:i') }}</td>
                            </tr>
                @endforeach
            @else
                //Ошибка вывода таблицы
            @endif

        </table>
    </main>
</div>
@endsection
