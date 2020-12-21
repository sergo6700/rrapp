@php
    /** @var \App\Models\Application\Application $entry */
    if ($entry->user && !$entry->user->name) {
        $fullName =  '-';
    }

    if ($entry->user) {
        $href = backpack_url('user') . "/{$entry->user->id}/edit";
        $format = '<a href="%s" target="_blank">%s</a>';

        $fullName = sprintf($format, $href, $entry->user->name);
    }

    if (!$entry->user && $entry->full_name) {
        $fullName = $entry->full_name ?? '';
    }

    if (!$entry->user && !$entry->full_name) {
        $fullName = '-';
    }

    $fullName = \Illuminate\Support\Str::limit($fullName, 30);
@endphp

<span>
    {!! $fullName !!}
</span>
