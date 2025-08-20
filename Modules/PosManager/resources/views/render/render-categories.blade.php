@forelse($categories as $key=> $category)
    <li class="list-inline-item">
        <button class="bg-light-subtle btn-sm border shadow-sm px-2 rounded-3 itemCategory"
                data-id="{{ $category->id }}">
            {{ $category->name }}
        </button>
    </li>
@empty
@endforelse
