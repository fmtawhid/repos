<div class="card-footer border-0 pt-0 bg-transparent">
    <div class="d-flex align-items-center justify-content-between">
        <span>  {{ $list->firstItem() ?? 0 }}-{{ $list->lastItem() ?? 0 }}  {{ localize('of') }}
            {{ $list->total() }} </span>
        <nav>
            {{ $list->appends(request()->input())->onEachSide(0)->links() }}
        </nav>
    </div>
</div>
