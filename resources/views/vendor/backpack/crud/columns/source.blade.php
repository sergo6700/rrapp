{{-- relationships with pivot table (n-n) --}}
@if ($entry)
    @php
        /** @var \App\Models\Acl\User $entry */
        $userSource = $entry->userSource;

        echo \App\Support\Enum\User\UserSourceType::getValue($userSource->source);
    @endphp
@endif