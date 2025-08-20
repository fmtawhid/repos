<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('AI Feature List') }}</h5>
    </div>
    <div class="card-body">
        @foreach ($aiFeatureList as $key => $item)
            <div class="row align-items-center border rounded m-2">
                <div class=" {{array_key_exists('engines', $item) ? 'col-lg-8' : 'col-12' }}">
                    <div class="form-check form-switch d-flex align-items-center gap-2 py-2">
                        <input  class="form-check-input flex-shrink-0 enableDisable"
                                data-entity="{{ $key }}"
                                type="checkbox"
                                @checked($item['is_active'])
                                role="switch"
                                id="{{ $key }}"
                        />

                        <label class="form-check-label flex-grow-1" for="{{ $key }}">
                            <span class="h6"> {{ localize($item['title']) }} </span>
                            <span class="d-block"> {{ localize($item['description']) }} </span>
                        </label>
                        
                    </div>
                </div>

                @if (array_key_exists('engines', $item))
                    @php
                        $entity = str_replace('enable_', '', $key).'_engine';
                    @endphp
                    <div class="col-lg-4 {{ $entity }}">
                        <x-form.label for="name" label="{{ localize('Default Engine') }}" isRequired=true />
                        <x-form.select name="{{ $key }}"
                            class="form-select form-select-transparent form-select--sm selectDefaultEngine" data-entity="{{$entity}}" id="">
                            <option value="">{{ localize("Select Engine") }}</option>
                            @foreach ($item['engines'] as $key => $name)
                                <option value="{{ $key }}" {{getSetting($entity) == $key ? 'selected':''}}>
                                    {{ localize($name) }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
