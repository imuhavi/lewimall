<div class="pagination text-right">
  @if ($paginator->onFirstPage())
  <li class="page-item disabled">
    <a class="page-link" href="#" tabindex="-1">Previous</a>
  </li>
  @else
  <li class="page-item">
    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">Previous</a>
  </li>
  @endif

  @for ($i = 1; $i <= $paginator->lastPage(); $i ++)
    <li class="page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}"><a class="page-link"
        href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
    @endfor

    @if ($paginator->hasMorePages())
    <li class="page-item">
      <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
    </li>
    @else
    <li class="page-item disabled">
      <a class="page-link" href="#">Next</a>
    </li>
    @endif
</div>


<div class="text-right">
  <span class="text-left">Showing Items- {{ $paginator->count() }} / Page No- {{ $paginator->currentPage() }} / Total
    Items-
    {{ $paginator->total() }}.</span>
</div>