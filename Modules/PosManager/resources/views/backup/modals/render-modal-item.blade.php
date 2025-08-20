
@forelse($products as $key=>$product)
    @php
        $productCombinationsCount = $product->combinations?->count() ?? 0;
        $productAttribute = $product->attributes?->first();

        $productPrice       = getProductPrice($product);
        $priceAfterDiscount = getProductDiscountByProductAttribute($productAttribute);

        $productThumb = getProductThumbnail($product);
    @endphp

    <div class="card mb-1 p-2">
        <div class="row ">
            {{-- Information--}}
            <div class="col-lg-8">
                <div class="img-left me-2">
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
                        {{ getProductTitle($product) }}
                    </h3>
                </div>
            </div>

            {{-- Price --}}
            <div class="col-lg-4 textRight">

                <span class="text-primary">
                    {{ formatPrice($priceAfterDiscount) }}
                </span>

                @if($productPrice != $priceAfterDiscount)
                    <del> {{ formatPrice($productPrice) }}</del>
                @endif

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
                            class="btn btn-primary btn-sm">
                        <i data-feather="shopping-bag"></i> {{ localize("Add") }}
                    </button>
                </form>
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
