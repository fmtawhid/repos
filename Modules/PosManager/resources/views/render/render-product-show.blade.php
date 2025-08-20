
<div class="modal-body p-lg-4 p-3">

    <form class="addToCart" action="{{ route('carts.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="avatar avatar-lg flex-shrink-0">
                        <img class="rounded-circle"
                             src="{{ urlVersion(getProductThumbnail($product))  }}"
                        />
                    </div>
    
                    <h5>{{ $product->title }}
                    </h5>
                </div>
                <x-form.input
                    type="hidden"
                    :showDiv="false"
                    name="product_id"
                    :value="$product->id"
                    id="product_id{{ $product->id }}"
                />

                <x-form.input
                    type="hidden"
                    :showDiv="false"
                    name="product_attribute_id"
                    :value="$product?->attributes?->first()?->id"
                    id="product_id{{ $product->id }}"
                />
            </div>
        </div>



        <div class="row">
            @if($product->variationCombinations)
                <x-common.product_variation :product="$product" />
            @else
                @php
                    $productAttribute = getProductAttribute($product);
                    $productAttributeId = $productAttribute?->id;
                @endphp

                <x-form.input
                    type="hidden"
                    name="product_attribute_id"
                    :value="$productAttributeId"
                    id="product_attribute_id{{ $productAttributeId }}"
                />

                <p class="m-0">{{ localize("Price") }}: {{ formatPrice(getProductPrice($product)) }}</p>
            @endif
        </div>

        <div class="d-flex align-items-center flex-wrap gap-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">{{ localize("Cancel") }}</button>
            <button type="submit" class="btn btn-primary btn-block">
                {{ localize("Add to Cart") }}
            </button>
            
        </div>
    </form>
</div>