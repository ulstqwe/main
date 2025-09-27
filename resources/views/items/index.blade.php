@extends('layouts.app')

@section('content')
    <!-- Основное содержимое -->
    <div class="container">
        <main class="content" >
            <a href="{{ route('items.create') }}" class="nav-btn-additem">Добавить предмет</a>
            <br><br>
            <h2>Список предметов</h2>
            <table>
                <thead>
                <tr>
                    <th>Название предмета</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>
                            <a href="{{ route('items.edit', $item->id) }}">Редактировать</a>
                            <form method="POST" action="{{ route('items.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </main>
    </div>
@endsection
