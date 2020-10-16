
@if ($paginator->hasPages())
<div class="container">
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      {{-- Если не на первой странице --}}
      @if (!$paginator->onFirstPage())
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Назад</a></li>
      @endif
      {{-- КонецЕсли --}}

      
      @foreach ($elements as $element)
        
        @foreach ($element as $num => $url)
          <li class="page-item{{ $num == $paginator->currentPage() ? ' disabled' : ''}}"><a class="page-link" href="{{ $url }}"> {{ $num }}</a></li>   
        @endforeach
        
      @endforeach
      
      {{-- Если на последней странице --}}
      @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Вперед</a></li>
      @endif
      {{-- КонецЕсли --}}
    </ul>
  </nav>
</div>
@endif

