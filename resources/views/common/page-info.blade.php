@if($paginator->hasPages())
    <div class="row g-2 g-md-4 align-items-center">
        <div class="col-md-2">
            <div class="d-flex align-items-center">
                <span class="d-block flex-shrink-0">
                    Per Page
                </span>
                <x-form.select name="per_page" id="per_page" class="form-select table-pagination-select">
                    @foreach (appStatic()::PER_PAGE_ARR as $pPerPage)
                        <option value="{{ $pPerPage }}" {{ $paginator->perPage() == $pPerPage ? 'selected' : '' }}>{{ $pPerPage }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>
        <div class="col-md-10">
            <div class="d-flex flex-wrap justify-content-md-end align-items-center g-2 g-md-4">
                <span class="d-inline-block">
                    @php
                    $currentPage = $paginator->currentPage();
                    $perPage = $paginator->perPage();

                    $from = ($currentPage - 1) * $perPage + 1;
                    $to = min($currentPage * $perPage, $paginator->total());
                    @endphp
                    Showing {{ $from }}-{{ $to }} of {{ $paginator->total() }} results
                </span>
                <nav>
                    <ul class="pagination">
                        @if ($paginator->onFirstPage())
                            <li class="page-item">
                                <span class="page-link"><i data-feather="chevron-left"></i></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                                    <i data-feather="chevron-left"></i>
                                </a>
                            </li>
                        @endif

                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <li class="disabled"><span>{{ $element }}</span></li>
                            @endif
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($paginator->currentPage() > 4 && $page === 2)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item d-none d-sm-block active" aria-current="page"><span class="page-link">{{ $page }}<span class="visually-hidden">(current)</span></span></li>
                                    @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage() + 2 || $page === $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page === $paginator->lastPage() || $page === 1)
                                        <li class="page-item d-none d-sm-block"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                    @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                                        <li class="page-item disabled"><span class="page-link">...</span></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                                    <i data-feather="chevron-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <span class="page-link"><i data-feather="chevron-right"></i></span>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
    </div>

@endif
