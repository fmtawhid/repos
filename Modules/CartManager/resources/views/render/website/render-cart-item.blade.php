@forelse ($globalCartData["cart_items"] as $cartItem)
    @php
        $product = $cartItem["product"];
    @endphp
    <li>
        <div class="d-flex align-items-center justify-content-between py-2">
            <div class="d-flex align-items-center gap-2">
                <a href="#" class="link d-grid place-content-center w-12 h-12 flex-shrink-0">
                    <img src="{{ urlVersion(getProductThumbnail($product)) }}"
                         alt="image"
                         class="w-100 h-100 object-fit-cover" />
                </a>
                <a href="#" class="link flex-grow-1 d-block">
                    <span class="fs-14 fw-semibold clr-title line-clamp line-clamp--1 :on-primary-container">
                        {{ getProductTitle($product) }}
                    </span>
                    <span class="fs-14 fw-semibold clr-text d-block">
                        {{ formatPrice(getCartItemPriceAfterDiscount($cartItem)) }}
                    </span>                   
                </a>
            </div>
            <div class="qty-btn qty-btn-sm">
                <button
                    type="button"
                    class="qty-btn__decrease is-cart-decrement plusMinusBtn"
                    data-id="{{ getCartId($cartItem) }}"
                    data-is_website="1"
                    data-qty_change="-1">
                    <i class="bi bi-dash"></i>
                </button>

                <input
                    type="text"
                    class="qty-btn__input form-control text-center"
                    value="{{ $cartItem['qty'] }}"
                />

                <button
                    type="button"
                    class="qty-btn__increase is-cart-increment plusMinusBtn"
                    data-id="{{ getCartId($cartItem) }}"
                    data-is_website="1"
                    data-qty_change="1">
                    <i class="bi bi-plus"></i>
                </button>

            </div>
        </div>
    </li>
@empty
    <div class="d-block mt-4 text-center">
        <img src="{{ asset('/piomart/images/empty-cart.jpg') }}" alt="empty cart" class="img-fluid p-5">
    </div>
@endforelse
