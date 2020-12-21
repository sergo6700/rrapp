{{-- checkbox with loose false/null/0 checking --}}
@php
    $checkValue = data_get($entry, $column['name']);

    $text = $checkValue? 'Да' : 'Нет';
@endphp

<span>
    {{ $text }}
</span>
