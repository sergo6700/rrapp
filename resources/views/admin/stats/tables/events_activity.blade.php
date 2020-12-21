<table class="table table-striped text-center">
    <tr>
        <td>Название мероприятия</td>
        <td>Дата</td>
        <td>Зарегистрировано</td>
        <td>Пришло</td>
    </tr>
    @foreach($records as $record)
    <tr>
        <td>{{ $record['title'] }}</td>
        <td>{{ $record['date'] }}</td>
        <td>{{ $record['registrations_count']  }}</td>
        <td>{{ $record['visited_count'] }}</td>
    </tr>
    @endforeach
</table>
