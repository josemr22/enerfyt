@if ($paginator->hasPages())
        <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button type="button" disabled class="flex-c-m how-pagination1 trans-04 m-all-7">
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
{{--                    <span class="page-link" aria-hidden="true">&lsaquo;</span>--}}
{{--                </li>--}}
                    &lsaquo;
                </button>
            @else
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
{{--                </li>--}}
                <a href="{{ $paginator->previousPageUrl() }}" class="flex-c-m how-pagination1 trans-04 m-all-7">
                    &lsaquo;
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
{{--                            <li class="active" aria-current="page"><a href="{{ $url }}" style="background: #f93a3a">{{ $page }}</a></li>--}}
                            <a href="{{ $url }}" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">
                                {{ $page }}
                            </a>
                        @else
{{--                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}

                            <a href="{{ $url }}" class="flex-c-m how-pagination1 trans-04 m-all-7">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
{{--                <li class="page-item">--}}
{{--                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
{{--                </li>--}}
                <a href="{{ $paginator->nextPageUrl() }}" class="flex-c-m how-pagination1 trans-04 m-all-7">
                    &rsaquo;
                </a>
            @else
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
{{--                    <span class="page-link" aria-hidden="true">&rsaquo;</span>--}}
{{--                </li>--}}
                <button disabled class="flex-c-m how-pagination1 trans-04 m-all-7">
                    &rsaquo;
                </button>
            @endif
    </div>
@endif