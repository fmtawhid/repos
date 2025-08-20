<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Subscription Setting') }}</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @foreach ($subscriptionFeatures as $key => $item)
                <div class="col-12">
                    <div class="form-check form-switch d-flex align-items-center gap-2 py-2 px-3 border rounded">
                        <label class="form-check-label flex-grow-1" for="{{ $key }}">
                            <span class="h6">
                                {{ localize($item['title']) }}
                            </span>
                            <span class="d-block">
                                {!! localize($item['description']) !!}
                            </span>
                        </label>
                        <input class="form-check-input flex-shrink-0 enableDisable" data-entity="{{ $key }}" type="checkbox"
                            {{ $item['is_active'] == 1 ? 'checked' : '' }} role="switch" id="{{ $key }}">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
