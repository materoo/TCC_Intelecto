@if ($paginator->hasPages())
   
        <div class="pagination">
            {{-- Link para a página anterior --}}
            @if ($paginator->onFirstPage())
            
            @else
                <a href="{{ $paginator->previousPageUrl() }}"><span><i class="bx bx-left-arrow icon"></i></span></a>
            @endif
            {{-- Links das páginas --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span >{{ $element }}</span>
                @endif
                {{-- Links das páginas --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span >{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Link para a próxima página --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"><span><i class="bx bx-right-arrow icon"></i></span></a>
            @else
            
            @endif
        </div>
@endif    

 



