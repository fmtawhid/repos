
@forelse($products as $key=>$product)
    @php
        $productAttribute = $product->attributes?->first();

        $totalAttributes = $product->attributes?->count() ?? 0;
        $hasMultiAttribute = $totalAttributes > 1;

        $productPrice       = getProductPrice($product);
        $priceAfterDiscount = getProductDiscountByProductAttribute($productAttribute);

        $productThumb = getProductThumbnail($product);
        $productTitle = getProductTitle($product);
    @endphp

    <div class="col {{ $hasMultiAttribute ? 'posProduct' : 'addCartItem' }}"
         data-id="{{ $product->id }}"
         data-modal="{{ $hasMultiAttribute }}"
    >
            <form action="{{ route('carts.store') }}" method="post" class="addToCart">
                @csrf
                {{-- Product Id --}}
                <x-form.input
                    type="hidden"
                    name="product_id"
                    value="{{ $product->id }}"
                />

                {{-- Product Attribute Id--}}
                <x-form.input
                    type="hidden"
                    name="product_attribute_id"
                    value="{{ $productAttribute->id }}"
                />

                <div class="tt-single-pos-item card rounded shadow-sm bg-light">
                    <div class="img-left">
                        <img
                            src="{{ urlVersion($productThumb) }}"
                            alt="products"
                            class="img-fluid rounded-top" />
                    </div>

                    <div class="d-flex flex-column p-2">
                        <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1 fw-medium">
                            {{ $productTitle }}
                        </h3>

                        <div class="heading-font fw-bold fs-sm">
                            @if($productPrice != $priceAfterDiscount)
                                <del class="text-muted"> {{ formatPrice($productPrice) }}</del>
                            @endif

                            <span>
                                {{ formatPrice($priceAfterDiscount) }}
                            </span>
                        </div>
                    </div>
                </div>
            </form>
    </div>
@empty
    <div class="col-auto card">
        <div class="text-center p-4">
            <p class="p-0 text-danger m-0">{{ localize("No Result found for") }} <b>{{ request()->search  }}</b></p>
        </div>
    </div>
@endforelse
