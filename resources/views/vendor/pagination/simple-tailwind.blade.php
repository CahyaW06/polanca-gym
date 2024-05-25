@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium cursor-default leading-5 rounded-l-md text-gray-600 bg-gray-800 border border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium border leading-5 rounded-l-md transition ease-in-out duration-150 bg-gray-800 border-gray-600 text-white hover:border-blue-500 hover:text-blue-500 focus:border-blue-700">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium border leading-5 rounded-r-md transition ease-in-out duration-150 bg-gray-800 border-gray-600 text-white hover:border-blue-500 hover:text-blue-500 focus:border-blue-700">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium cursor-default leading-5 rounded-r-md text-gray-600 bg-gray-800 border border-gray-600">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
