@if ($paginator->hasPages())
    <nav class="pagination-wrapper">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span>&laquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled">
                        <span>{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <span>{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
                </li>
            @else
                <li class="disabled">
                    <span>&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 24px;
    }

    .pagination-list {
        list-style: none;
        display: flex;
        gap: 4px;
        margin: 0;
        padding: 0;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }

    .pagination-list li {
        margin: 0;
    }

    .pagination-list a,
    .pagination-list span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 0 6px;
        border: 1px solid #e8ecf1;
        border-radius: 4px;
        text-decoration: none;
        color: #007E7A;
        font-size: 12px;
        font-weight: 600;
        font-family: "Montserrat", sans-serif;
        transition: all 0.2s ease;
    }

    .pagination-list a:hover {
        background: #007E7A;
        color: white;
        border-color: #007E7A;
    }

    .pagination-list li.active span {
        background: #007E7A;
        color: white;
        border-color: #007E7A;
    }

    .pagination-list li.disabled span {
        color: #ccc;
        cursor: not-allowed;
        border-color: #e8ecf1;
    }
</style>
