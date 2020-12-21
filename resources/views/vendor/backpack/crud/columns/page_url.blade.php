@php
    $keyName = isset($column['key']) ? $column['key'] : $column['name'];
    $page_url = data_get($entry, $keyName);

    $link = '—';
    if ($page_url) {
        $page_title = data_get($entry, 'page_title');
        if (!$page_title) {
            $pattern = '/^http(s)?:\/\//';
            $replacement = '';
            $page_title = preg_replace($pattern, $replacement, $page_url);
        }

        $page_title = \Illuminate\Support\Str::limit($page_title, 30);
        $link = "<a href='$page_url' target='_blank' title='$page_url'>$page_title</a>";
    }
@endphp

<span>
    {!! $link !!}
</span>