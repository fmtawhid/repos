@forelse(getCartItems() as $cartItem)
    @php
        $product                = $cartItem["product"];
        $productAttribute       = $cartItem["productVariation"];
        $productPrice           = getProductPrice($product);
        $productDiscountedPrice = getProductDiscountByProductAttribute($productAttribute);

        $addonPrice = 0;
        $addonPrice = collect($cartItem["product_addons"] ?? [])
            ->sum('price');

        $productSubTotal        = getCartItemSubTotal($cartItem);

        $productSubTotalWithAddonPrice = $productSubTotal + $addonPrice;
    @endphp

    <li class="rounded bg-light border-0 p-3 shadow-sm w-100">
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div>
                    <h3 class="fs-md mb-0 tt-line-clamp tt-clamp-1 fw-medium">
                        {{ $product->name }}
                    </h3>
                    <ul class="list-unstyled ps-0 d-flex flex-column gap-1">
                        {{-- Selected Variations --}}
                        <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                            <strong>{{ localize("Variant") }}:</strong> {{ $productAttribute->title }}
                        </li>

                        @if(!empty($cartItem["product_addons"]))
                            {{-- Addons--}}
                            <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                <strong>{{ localize("Add-ons") }}:</strong>
                            </li>

                            @foreach($cartItem["product_addons"] as $addon)
                                <li class="badge bg-secondary text-body-secondary rounded-pill me-2">
                                    {{ $addon["title"] }} - {{ formatPrice($addon["price"]) }}
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <button type="button"
                        class="border-0 px-2 bg-transparent removeCartItem"
                        data-id="{{ getCartId($cartItem) }}">
                    <i data-feather="trash-2" class="icon-16 text-danger"></i>
                </button>
            </div>
            <div class="d-flex justify-content-between align-items-center">

                <div class="heading-font fw-bold fs-sm">
                    @if($productDiscountedPrice > $productPrice)
                        <del class="text-body-secondary">{{ formatPrice($productPrice) }}</del>
                    @endif

                    <span>
                        {{ formatPrice($productSubTotalWithAddonPrice) }}
                        <small class="fw-normal"> ({{ formatPrice($productSubTotal) }} + {{ formatPrice($addonPrice) }}) </small>
                    </span>
                </div>

                <div class="tt-num-block">
                    <div class="tt-num-input">
                        <span class="tt-minus tt-dis plusMinusBtn" data-id="{{ getCartId($cartItem) }}" data-qty_change="-1"></span>
                        <input type="text" class="tt-in-num fs-xs" value="{{ $cartItem['qty'] }}">
                        <span class="tt-plus plusMinusBtn" data-id="{{ getCartId($cartItem) }}" data-qty_change="1"></span>
                    </div>
                </div>
            </div>
        </div>
    </li>

@empty
@endforelse
