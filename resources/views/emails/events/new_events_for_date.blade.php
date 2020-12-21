<p>Вчера были добавлены следующие мероприятия:</p>

@foreach($data as $event)
<ul>
    <li>
        <a href="{{ route('event.show', $event->slug) }}">{{ $event->title }}</a>
    </li>
</ul>
@endforeach

<p>Для регистрации на мероприятие, перейдите на его страницу на сайте.</p>