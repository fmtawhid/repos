
@forelse($products as $key=>$product)
    @php
        $productCombinationsCount = $product->combinations?->count() ?? 0;
        $productAttribute = $product->attributes?->first();

        $productPrice       = getProductPrice($product);
        $priceAfterDiscount = getProductDiscountByProductAttribute($productAttribute);
        $productThumb = getProductThumbnail($product);

    @endphp

    <div class="col-auto posProduct"
         data-id="{{ $product->id }}"
         data-modal="{{ $productCombinationsCount > 0 }}">

        <div data-modal="false" class="tt-single-pos-item card border-0 flex-row align-items-center p-2">
            <div class="img-left me-2 flex-shrink-0">
                <img src="{{ urlVersion($productThumb) }}"
                     data-src="{{ urlVersion($productThumb) }}"
                     alt="{{ $product->title }}"
                     class="img-fluid"
                />
            </div>

            <div class="d-flex flex-column">
                <small class="text-muted">
                    {{ localize("Barcode") }}: {{ getProductBarcodeByProductAttribute($productAttribute) }}
                </small>
                <h3 class="fs-md mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                    {{ $product->title }}
                </h3>
                <div class="heading-font fw-bold fs-sm">
                    <span class="text-primary">
                        {{ formatPrice($priceAfterDiscount) }}
                    </span>

                    @if($productPrice != $priceAfterDiscount)
                        <del> {{ formatPrice($productPrice) }}</del>
                    @endif
                </div>


                @if($productCombinationsCount<= 0)
                    <form class="addToCart" action="{{ route('carts.store') }}" method="POST">
                        @csrf

                        <x-form.input
                            type="hidden"
                            :showDiv="false"
                            name="product_id"
                            value="{{ $product->id }}"
                        />

                        <x-form.input
                            type="hidden"
                            :showDiv="false"
                            name="product_attribute_id"
                            value="{{ $product?->attributes?->first()?->id }}"
                        />


                        <button type="submit"
                                class="btn btn-primary btn-sm mt-2">
                            <i data-feather="shopping-bag" class="icon-14"></i> {{ localize("Add") }}
                        </button>
                    </form>
                @else
                    <div class="d-block">
                        <button type="button"
                            data-id="{{ $product->id }}"
                            data-modal="{{ $productCombinationsCount > 0 }}"
                            class="btn btn-primary btn-sm posProduct mt-2">
                            <i data-feather="shopping-bag" class="icon-14"></i> {{ localize("Select") }}
                        </button>
                    </div>
                @endif

            </div>

        </div>

    </div>
@empty
    <div class="col-auto card">
        <div class="text-center p-4">
            <p class="p-0 text-danger m-0">{{ localize("No Result found for") }} <b>{{ request()->search  }}</b></p>
        </div>
    </div>
@endforelse
