@foreach($data['lots'] as $item)
    <tr>
        <td><strong>{{ $item['itemId'] }}</strong></td>
        <td>{{ $item['amount'] }}</td>
        <td>{{ number_format($item['startPrice'], 0, ',', ' ') }} ₽</td>
        <td>{{ number_format($item['buyoutPrice'], 0, ',', ' ') }} ₽</td>
        <td>{{ \Carbon\Carbon::parse($item['endTime'])->format('d.m.Y H:i') }}</td>
    </tr>
@endforeach
