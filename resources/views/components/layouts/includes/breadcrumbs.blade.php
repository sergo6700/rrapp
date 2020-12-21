@if (count($breadcrumbs))

    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach ($breadcrumbs as $key => $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                    itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="{{ $breadcrumb->url }}">
                        <span itemprop="name">{{ $breadcrumb->title }}</span>
                    </a>
                    <svg arial-hidden="true" focusable="false" width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.00009 0L0.590088 1.41L5.17009 6L0.590088 10.59L2.00009 12L8.00009 6L2.00009 0Z" fill="#808285"/>
                    </svg>
                    <meta itemprop="position" content="{{ ++$key }}" />
                </li>
            @else
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name">{{ $breadcrumb->title }}</span>
                    <meta itemprop="position" content="{{ ++$key }}" />
                </li>
            @endif

        @endforeach
    </ol>

@endif