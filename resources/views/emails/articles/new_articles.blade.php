<p>На прошлой неделе были добавлены следующие статьи:</p>

@foreach($data as $article)
    <ul>
        <li>
            <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
        </li>
    </ul>
@endforeach