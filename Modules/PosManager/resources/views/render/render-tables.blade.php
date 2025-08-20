@forelse($areas as $area)
    {{-- area start --}}
    <div class="areaMain mb-5">
        <div class="mb-3 border-bottom">
            <strong>{{ $area->name }}</strong>
            <small>{{ localize("Available table") }} <strong>{{ $area->tables?->count() ?? 0}}</strong></small>
        </div>

        <div class="row g-2 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-4">
            @forelse($area->tables as $table)
                <div class="col pickTable " data-table_id="{{ $table->id }}">
                    <div class="tt-table-item border rounded-3 p-2 cursor-pointer tableItem{{ $table->id }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fs-sm px-2 py-1 text-primary bg-soft-primary">{{ $table->table_code ?? "" }} </h6>
                        </div>
                        <span class="text-muted fs-sm">{{ localize("Seats of Capacity") }}
                            <strong>
                                {{ $table->number_of_seats }}
                            </strong>
                        </span>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    {{-- area close --}}
@empty
@endforelse
