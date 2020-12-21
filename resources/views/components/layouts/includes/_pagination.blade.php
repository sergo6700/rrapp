@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button class="pagination-arrow pagination-arrow_left text_PT-font text_bold{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M6.29289 13.7071C6.68342 14.0976 7.31658 14.0976 7.70711 13.7071C8.09763 13.3166 8.09763 12.6834 7.70711 12.2929L2.41421 7L7.70711 1.70711C8.09763 1.31658 8.09763 0.683417 7.70711 0.292893C7.31658 -0.0976311 6.68342 -0.0976311 6.29289 0.292893L0.292893 6.29289C-0.0976311 6.68342 -0.0976311 7.31658 0.292893 7.70711L6.29289 13.7071Z"
                          fill="#C59368"></path>
                </svg>
            </button>
        @else
            <button onclick="window.location='{{ $paginator->url($paginator->currentPage() - 1) }}'"
                    class="pagination-arrow pagination-arrow_left text_PT-font text_bold">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M6.29289 13.7071C6.68342 14.0976 7.31658 14.0976 7.70711 13.7071C8.09763 13.3166 8.09763 12.6834 7.70711 12.2929L2.41421 7L7.70711 1.70711C8.09763 1.31658 8.09763 0.683417 7.70711 0.292893C7.31658 -0.0976311 6.68342 -0.0976311 6.29289 0.292893L0.292893 6.29289C-0.0976311 6.68342 -0.0976311 7.31658 0.292893 7.70711L6.29289 13.7071Z"
                          fill="#C59368"></path>
                </svg>
            </button>
        @endif

        <ul class="pagination__list">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))

                    <li class="pagination__item">
                        <span class="pagination__link text_PT-font text_bold">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination__item">
                                <a href="{{ $url }}"
                                   class="link pagination__link pagination__link_active text_PT-font text_bold">{{ $page }}</a>
                            </li>
                        @else
                            <li class="pagination__item">
                                <a href="{{ $url }}"
                                   class="link pagination__link text_PT-font text_bold">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button onclick="window.location='{{ $paginator->url($paginator->currentPage()+1) }}'"
                    class="pagination-arrow pagination-arrow_right text_PT-font text_bold">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M1.70711 0.292893C1.31658 -0.097631 0.683418 -0.097631 0.292893 0.292893C-0.097631 0.683418 -0.097631 1.31658 0.292893 1.70711L5.58579 7L0.292893 12.2929C-0.097631 12.6834 -0.097631 13.3166 0.292893 13.7071C0.683418 14.0976 1.31658 14.0976 1.70711 13.7071L7.70711 7.70711C8.09763 7.31658 8.09763 6.68342 7.70711 6.29289L1.70711 0.292893Z"
                          fill="#C59368"></path>
                </svg>
            </button>
        @else
            <button class="pagination-arrow pagination-arrow_right text_PT-font text_bold{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M1.70711 0.292893C1.31658 -0.097631 0.683418 -0.097631 0.292893 0.292893C-0.097631 0.683418 -0.097631 1.31658 0.292893 1.70711L5.58579 7L0.292893 12.2929C-0.097631 12.6834 -0.097631 13.3166 0.292893 13.7071C0.683418 14.0976 1.31658 14.0976 1.70711 13.7071L7.70711 7.70711C8.09763 7.31658 8.09763 6.68342 7.70711 6.29289L1.70711 0.292893Z"
                          fill="#C59368"></path>
                </svg>
            </button>
        @endif
    </div>
@endif
