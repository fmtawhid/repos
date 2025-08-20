<form action="{{ route('carts.store') }}" method="post" class="addToCart">
    @csrf

    <x-form.input
        type="hidden"
        name="product_id"
        value="{{ $product->id }}"
    />


    <h2 class="modal-title h5 border-bottom mb-3" id="productVariationLabel">
        {{ localize("Select Your Variation") }}
    </h2>

    <div class="d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 ">{{ getProductTitle($product) }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <p class="fs-5 fw-semibold mt-2 ">
        {{ formatPrice(getProductPrice($product)) }}
    </p>

    <div class="variation-box">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-semibold">{{ localize("Variation") }}</span>
            <span class="badge bg-light text-muted">{{ localize("Price") }}</span>
        </div>

        @forelse($product->attributes as $attribute)
            <div class="form-check">
                <div>
                    <input class="form-check-input"
                           type="radio"
                           value="{{ $attribute->id }}"
                           name="product_attribute_id"
                           id="product_attribute_id{{ $attribute->id }}"
                    />
                    <label class="form-check-label" for="product_attribute_id{{ $attribute->id }}">
                        {{ $attribute->title }}
                    </label>
                </div>
                <span class="text-muted">
                    {{ formatPrice($attribute->price) }}
                </span>
            </div>
        @empty
        @endforelse
    </div>

    {{-- Addons --}}
    @php
        $productAddons = $product->product_addons;
    @endphp

    @if(!empty($productAddons))
        <div class="section-title d-flex align-items-center modalAddonsTitle">
            {{ localize("Add Ons") }}
            <span class="optional-label">{{ localize("Optional") }}</span>
        </div>

        <div class="addonLists">
            {{-- Addons --}}

            @php
                $productAddons = $product->product_addons;
            @endphp

            @forelse($productAddons as  $key=>$productAddon)

                <input
                    type="hidden"
                    name="addon_title_{{ $key }}"
                    value="{{ $productAddon["title"] }}"
                />

                <input
                    type="hidden"
                    name="addon_price_{{ $key }}"
                    value="{{ $productAddon["price"] }}"
                />

                <div class="form-check mb-3">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="selected_addons[]"
                        value="{{ $key }}"
                        id="cheeseAddon{{ $key }}"
                    />

                    <label class="form-check-label d-flex justify-content-between w-100"
                           for="cheeseAddon{{ $key }}">
                        <span>{{ $productAddon["title"] }}</span>
                        <span class="text-muted">+ {{ formatPrice($productAddon["price"] ?? 0)  }}</span>
                    </label>
                </div>
            @empty
            @endforelse
        </div>
    @endif

    <div class="modal-footer justify-content-start border-top-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ localize("Cancel") }}</button>
        <button type="submit" class="btn btn-primary">{{ localize("Add Item") }}</button>
    </div>
</form>

