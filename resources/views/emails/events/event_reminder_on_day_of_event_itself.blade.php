<p>
    Сегодня в {{ $data->date_from->format('H:i d.m.Y') }} состоится мероприятие <a href="{{ route('event.show', $data->slug) }}">{{ $data->title }}</a> по адресу {{ $data->address->title }}
</p>