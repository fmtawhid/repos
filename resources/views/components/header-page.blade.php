@isset($pages)
    @if (count($pages) > 0)
        <li class="nav-item contain-sub-1 dropdown">
            <a class="nav-link" href="#">
                {{ localize('Pages') }}
            </a>
            <ul class="contain-sub-1__content contain-sub-1__content-sm list-unstyled">
                @foreach ($pages as $item)
                    <li>
                        <a href="{{ route('pages', $item->slug) }}"
                            class="contain-sub-1__link d-block text-decoration-none fs-14 text-dark hover:text-primary py-1">
                            {{ $item->title }}
                        </a>
                    </li>
                @endforeach

            </ul>
        </li>
    @endif
@endif
