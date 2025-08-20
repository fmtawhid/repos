@forelse ($globalCartData["cart_items"] as $cartItem)
    @php
        $product           = $cartItem["product"];
        $productVariation  = $cartItem["productVariation"];
        $totalCombinations = $productVariation?->combinations->count() ?? 0;
    @endphp

    <tr>
        <th scope="row">
            <div class="rounded background d-flex align-items-center gap-2">
                <a href="#" class="link d-inline-block w-10 flex-shrink-0">
                    <img src="{{ urlVersion(getProductThumbnail($product)) }}"
                         alt="image"
                         class="img-fluid"
                    />
                </a>
                <div class="flex-grow-1">
                    <a href="#" class="link line-clamp line-clamp--2 fs-12 clr-title :on-primary-container fw-semibold mb-1">
                        {{ getProductTitle($product) }}
                    </a>

                    @if ($totalCombinations > 0)
                        <div class="d-flex align-items-center">
                            @include("common.cart-combination",["productVariation" => $productVariation])
                        </div>
                    @endif
                </div>                    
            </div>           

            {{-- @dd($cartItem) --}}
            @if(isset($cartItem["item_tax_summary"]) && count($cartItem["item_tax_summary"]) > 0)
                @foreach ($cartItem["item_tax_summary"] as $taxSummary)
                    <span class="d-inline-block fs-12 clr-text clr-opacity-7">
                        {{ $taxSummary["title"] }}
                    </span>
                    <div class="d-inline-block fs-12 clr-text clr-opacity-7">
                        ({{ $taxSummary["tax_percentage"] }}%)
                    </div>
                    <span class="d-inline-block fs-12 clr-text clr-opacity-7">
                        {{ formatPrice($taxSummary["tax_amount"]) }}
                    </span>                   
                @endforeach
            @endif

        </th>
        <td>
            <span class="d-block fs-14">
                {{ formatPrice(getCartItemPriceAfterDiscount($cartItem)) }}
            </span>
        </td>
        <td>
            <div class="qty-btn">
                <button type="button" class="qty-btn__decrease is-cart-decrement plusMinusBtn"
                        data-id="{{ getCartId($cartItem) }}"
                        data-is_website="1"
                        data-qty_change="-1">
                    <i class="bi bi-dash"></i>
                </button>
                
                <input type="text"
                       class="qty-btn__input form-control text-center"
                       value="{{ $cartItem['qty'] }}">

                <button type="button" class="qty-btn__increase is-cart-increment plusMinusBtn"
                        data-id="{{ getCartId($cartItem) }}"
                        data-is_website="1"
                        data-qty_change="1">
                    <i class="bi bi-plus"></i>
                </button>
            </div>
        </td>
        <td>
            <span class="d-block fw-semibold clr-title fs-14"> {{ formatPrice(getCartItemSubTotal($cartItem)) }} </span>
        </td>
        <td>
            <button type="button" class="p-0 border-0 bg-transparent w-8 h-8 d-grid place-content-center clr-title :on-primary-container transition removeCartItem" data-id="{{ getCartId($cartItem) }}">
                <i class="bi bi-trash3"></i>
            </button>
        </td>
    </tr>
@empty
@endforelse
