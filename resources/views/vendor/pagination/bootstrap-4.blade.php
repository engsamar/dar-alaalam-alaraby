@if ($paginator->hasPages())
<div class="pagination pagination-area">
    <div class="nav-links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="page-numbers previous disabled" aria-hidden="true"><i class='bx bx-chevrons-left'></i></a>
            @else
            <a class="page-numbers previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" title="@lang('pagination.previous')"><i class='bx bx-chevrons-left'></i></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="page-numbers disabled">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="page-numbers current">{{ $page }}</a>
                        @else
                            <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>

                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="page-numbers next disabled" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class='bx bx-chevrons-right'></i></a>
            @else
                <a class="page-numbers next" aria-hidden="true"><i class='bx bx-chevrons-right'></i></a>
            @endif
    </div>
</div>
@endif
