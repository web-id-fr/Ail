@if ($paginator->hasPages())
    <nav class="pagination" role="navigation" aria-label="pagination">
        <ul class="pagination-list">
            <li>
                @if($paginator->onFirstPage())
                    <a class="pagination-previous is-disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">Previous</a>
                @else
                    <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
                @endif
            </li>
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="pagination-ellipsis">&hellip;</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <a class="pagination-link is-current" aria-label="Page {{ $page }}" aria-current="page" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="pagination-link" aria-label="Goto page {{ $page }}" href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            <li>
                @if($paginator->hasMorePages())
                    <a class="pagination-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next page</a>
                @else
                    <a class="pagination-next is-disabled" aria-disabled="true" aria-label="@lang('pagination.next')">Next page</a>
                @endif
            </li>
        </ul>
    </nav>
@endif
