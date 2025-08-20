<script>
    "use strict";

    var POS_DASHBOARD = "{{ route('pos.dashboard') }}";
    var URL_CART_INFO = `${POS_DASHBOARD}?loadCarts=true`;

    // Add To Cart URL
    var URL_ADD_CART = "{{ route('carts.store') }}";

    // Update Cart
    var URL_UPDATE_CART = "{{ route('carts.update',':id') }}";

    // Cart Item Delete
    var URL_CART_ITEM_DELETE = "{{ route('carts.destroy',':id') }}";

    // Customer Modal ID
    var CUSTOMER_MODAL_ID = "#addCustomerModal";

    // POS Customer Register URL
    var POS_CUSTOMER_REGISTER_URL = "{{ route('pos.customer.register') }}";

    var URL_PRODUCT_SHOW = "{{ route('admin.products.show',':id') }}";


    var IS_POS_ROUTE = "{{ isPOSRoute() ? 1 : 2 }}";
    var IS_CUSTOMER_CHECKOUT_ROUTE = "{{ isCustomerCheckoutRoute() ? 1 : 2 }}";
    var isWebsiteShop = "{{ isWebsiteShop() ? 1 : 2 }}";

    // Product
    var product = null;


    // Product Skeleton
    var productSkeleton = `<div class="col productSkleton">
    <div class="d-flex flex-column h-100 card-state style_new background p-3 rounded tt-placeholder">
        <div class="tt-img-wrap position-relative overflow-hidden">
            <a href="#" class="tt-img tt-placeholder">
                <img src="{{ defaultImage() }}"
                    class="img-fluid"
                    loading="lazy"
                    alt="product name">
            </a>
        </div>
        <div class="tt-product-info pt-3 line-container">
            <div class="mb-2 placeholder-line h-12 w-100"></div>
            <div class="placeholder-line h-8 w-60 mb-2"></div>
            <div class="mb-2 placeholder-line h-8 w-40"></div>

            <div class="d-flex align-items-center justify-content-between mt-2">
                <div class="placeholder-line h-20 w-60"></div>
            </div>
        </div>
    </div>
</div>`;



    $(() => {
        getCartInfo();

        // Load More BTN.
        showLoadMoreBtn();


        // Selected Variants
        selectedVariants();
    })

    function isPosRoute() {

        return parseInt(IS_POS_ROUTE) === 1;
    }

    function isCustomerCheckoutRoute() {

        return parseInt(IS_CUSTOMER_CHECKOUT_ROUTE) == 1;
    }

    var addBtnHtml = `<button type="submit" class="btn btn-primary btn-sm">
         <i data-feather="shopping-bag"></i> {{ localize("Add") }}
    </button>`;

    // addCartItem
    $(document).on("click", ".addCartItem", function(e) {
        e.stopPropagation();

        // Find and submit the form
        $(this).find('.addToCart').submit();
    });


    // Product Quick View Start

    $(document).on("click", ".posProduct", function() {
        let productId = $(this).data("id");
        let hasModal = $(this).attr("data-modal");

        if (hasModal) {
            $(".product_modal").modal("show");

            // Title Loading
            $(".singleProductModalTitle").html("<div class='text-center'><i class='fa fa-spinner fa-spin fa-3x fa-fw'></i> Loading Product Title</div>");

            // Body loading
            let loaderContent = `<div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>Item is Loading... `;

            $(".posModalContent").html(loaderContent);

            let productShowUrl = URL_PRODUCT_SHOW.replace(":id", productId);

            $.ajax({
                url: productShowUrl,
                type: "GET",
                dataType: "html",
                success: function(response) {

                    $(".posModalContent").html(response);
                },
                error: function(error) {
                    console.log("Product Show Err", error, error.responseJSON);
                }
            });
        }
    });
    // Product Quick View Start

    // Add To Cart
    $(document).on("submit", ".addToCart", function(e) {
        e.preventDefault();

        // submit btn loading added
        let submitBtn = $(this).find("button[type='submit']");
        let originalBtnContent = submitBtn.html();
        submitBtn.prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

        let formData = $(this).serialize() + "&is_pos_route=" + IS_POS_ROUTE;


        // Check if `qty_change` already exists in serialized formData
        if (!formData.includes("qty_change")) {
            formData += "&qty_change=1";
        }

        let modalId = $(this).attr("data-modal_id");
        let modalSelector = "";

        if (!modalId) {
            modalSelector = ".product_modal";
        } else {
            modalSelector = `#${modalId}`;
        }

        let callParams = {};

        callParams.url = $(this).attr("action");
        callParams.type = $(this).attr("method");
        callParams.data = formData;


        $.ajax({
            url: callParams.url,
            type: callParams.type,
            data: callParams.data,
            success: function(response) {

                toast(response.message);

                // submit btn loading added
                submitBtn.prop("disabled", false).html(originalBtnContent);


                // Hide Modal
                $(modalSelector).modal("hide");

                // Load Cart Details
                getCartInfo();
            },
            error: function(xhr, ajaxOptions, thrownError) {

                submitBtn.prop("disabled", false).html(originalBtnContent);

                console.log("Error:", xhr, ajaxOptions, thrownError);
                let errorJson = xhr.responseJSON;

                toast(errorJson.message, "error");

                if (errorJson.response_code == 401) {
                    // redirect to the login page

                    toast("{{ localize('Please login to add to cart') }}", "error");

                    window.location.href = "{{ route('login') }}";
                    return;
                }
            }
        })
    });



    $(document).on("click", ".removeCartItem", function() {

        let cartId = $(this).attr("data-id");

        // Final URL Prepare
        let finalUrl = URL_CART_ITEM_DELETE.replace(":id", cartId);
        finalUrl += `?is_pos_route=${IS_POS_ROUTE}`;

        let callParams = {};

        callParams.url = finalUrl;
        callParams.type = "POST";
        callParams.data = {
            _token: "{{ csrf_token() }}",
            _method: "DELETE",
        };

        $.ajax({
            url: callParams.url,
            type: callParams.type,
            data: callParams.data,
            dataType: "JSON",
            success: function(response) {
                toast(response.message);
                // Load Cart Details

                $(`.removeCartItem[data-id="${cartId}"]`).closest('tr').remove();


                getCartInfo();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                toast(xhr.responseJSON.message, "error");

                console.log("Error:", xhr, ajaxOptions, thrownError);
            }
        })
    });

    /**
     * Load POS Dashboard
     *  - Cart Items
     *  - sub-total
     *  - tax
     *  - grand total
     * */
    function getCartInfo() {
        @auth
            let finalURL = `${URL_CART_INFO}&is_pos_route=${IS_POS_ROUTE}&isCustomerWebsite=${IS_CUSTOMER_CHECKOUT_ROUTE}`;

            loading(".loader");
            $.ajax({
                url: finalURL,
                dataType: "json",
                success: function(response) {
                    if (isPosRoute()) {
                        posDataSet(response);
                    } else {
                        // Website Data Set
                        $(".loader").empty();
                        websiteDataSet(response);
                    }

                    // Customer Checkout Page Cart List
                    customerCheckoutDataSet(response);

                    // Feather Re-Call
                    cartInitFeather();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log("Error:", xhr, ajaxOptions, thrownError);
                }
            });
        @endauth
    }

    function cartInitFeather() {
        if (typeof feather !== "undefined") {
            feather.replace();
        }
    }

    function websiteDataSet(response) {

        // Cart Total QTY
        updateCartElement(".cartTotalQty", response.data.cart_total_qty ?? 0);

        // Load Cart Items
        updateCartElement(".websiteCartItems", response.data.cart_items);

        // Sub-total
        updateCartElement(".websiteSubTotal", response.data.sub_total);

        // Tax
        updateCartElement(".websiteCartTax", response.data.tax);

        // Grand Total
        updateCartElement(".websiteCartGrandTotal", response.data.grand_total);
    }



    function customerCheckoutDataSet(response) {
        // Load Cart Items
        if (response.data.customer_checkout_cart_items) {
            updateCartElement(".checkoutCartItems", response.data.customer_checkout_cart_items);
        }

        // Sub-total
        updateCartElement(".checkoutSubTotal", response.data.sub_total);

        // Tax
        updateCartElement(".checkoutTax", response.data.tax);

        // Grand Total
        updateCartElement(".checkoutGrandTotal", response.data.grand_total);
    }

    function updateCartElement(selector, data) {
        if ($(selector).length) {
            $(selector).empty().html(data);
        }
    }

    function posDataSet(response) {

        // Load Cart Items
        updateCartElement(".posCartItems", response.data.cart_items);

        // Sub-total
        updateCartElement(".posCartSubTotal", response.data.sub_total);

        // Tax
        updateCartElement(".posCartTax", response.data.tax);

        // Grand Total
        updateCartElement(".posCartGrandTotal", response.data.grand_total);
    }

    // Plus/Minus Btn
    $(document).on("click", ".plusMinusBtn", function(e) {
        let cartId = $(this).attr("data-id");
        let qtyChange = $(this).attr("data-qty_change");

        let updateRoute = URL_UPDATE_CART.replace(":id", cartId);


        let formData = {
            cart_id: cartId,
            qty_change: qtyChange,
            _method: 'PUT',
            _token: "{{ csrf_token() }}",
            is_pos_route: IS_POS_ROUTE
        }


        // Write Ajax Request here
        $.ajax({
            url: `${updateRoute}`,
            method: "POST",
            data: formData,
            dataType: "JSON",
            success: function(response) {
                toast("{{ localize('Cart has been updated') }}");
                // Load Cart Info
                getCartInfo();
            },
            error: function(xhr) {
                console.log("Error", xhr.responseJSON);

                toast(xhr.responseJSON.message, "error");
            }
        });
    });

    // New Customer Btn
    $(document).on("click", ".newCustomerBtn", function() {
        // Show Customer Modal
        $(CUSTOMER_MODAL_ID).modal("show");
    });

    // Save New Customer
    $(document).on("submit", "#customerFrm", function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        // Token Append
        // formData.append("_token","{{ csrf_token() }}");

        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: formData,
            dataType: "JSON",
            success: function(response) {
                toast("{{ localize('Customer is saved') }}");

                // Hide Customer Add Modal
                $(CUSTOMER_MODAL_ID).modal("hide"); 
                // Load customers
                loadVendorCustomers(); 
            },
            error: function(xhr) {
                console.log("Error", xhr, xhr.responseJSON);
            }
        });
    });





    //=========================================
    // for quick product view
    //=========================================
    $(document).on('click', '.product_quick_view', function(e) {
        $("#quickViewModal").modal("show");

        $(".quickViewModalBody").html(productSkeleton);

        let product_id = $(this).attr('data-id');
        if (product_id) {
            loadSingleProduct(product_id);
        }
    });


    // Attach event delegation for increment/decrement buttons
    $(document).on("click", ".is-cart-increment", function() {
        let cartInput = $(this).prev("input");
        cartInput.val(parseInt(cartInput.val()) + 1);
    });

    $(document).on("click", ".is-cart-decrement", function() {
        let cartInput = $(this).next("input");
        cartInput.val(Math.max(parseInt(cartInput.val()) - 1, 0));
    });

    function loadSingleProduct(product_id) {
        let callParams = {};

        let url        = '{{ route("quick_view_product.show", ["product_id" => ":product_id"]) }}';
        url            = url.replace(':product_id', product_id);
        callParams.url = url;

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(response) {
                product = response.additional?.product;

                $(".quickViewModalBody").html(response.data);

                // Re-initialize Swiper when the modal is shown
                const productSliderNav = document.querySelector(".product-slider-nav");
                if (productSliderNav) {
                    var productSliderNavInit = new Swiper(productSliderNav, {
                        slidesPerView: 2,
                        spaceBetween: 16,
                        breakpoints: {
                            375: {
                                slidesPerView: 3,
                            },
                            576: {
                                slidesPerView: 4,
                            },
                            1200: {
                                slidesPerView: 5,
                            },
                        },
                        watchSlidesProgress: true,
                        freeMode: true,
                    });
                }

                const productSliderFor = document.querySelector(".product-slider-for");
                if (productSliderFor) {
                    new Swiper(productSliderFor, {
                        slidesPerView: 1,
                        spaceBetween: 16,
                        thumbs: {
                            swiper: productSliderNavInit,
                        },
                    });
                }

                loadImgSrc();
            },
            error: function(error) {
                console.log("Product Show", error.responseJSON);
            }
        });

    }

    function loading(selector, text = "Loading...") {
        $(selector)
            .html(
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' +
                text
            )
            .prop("disabled", true);
    }



    /**
     * ******************************************
     *       Product Variation Price Start
     * ******************************************
     * */
    var variation_price                = 0;
    var variation_price_after_discount = 0;
    var DISCOUNT_TYPE_PERCENTAGE       = 1;
    var DISCOUNT_TYPE_FLAT_AMOUNT      = 2
    var selectedValues                 = [];
    var PRODUCT_SKU                    = "";


    /**
     * Generate Variation Key
     * */
    var generate_variation_key = function() {
        let variation = '';
        for (let i = 0; i < selectedValues.length; i++) {
            variation += selectedValues[i];
            if (i < selectedValues.length - 1) {
                variation += '_'; // Add an underscore between values (except for the last one)
            }
        }

        return variation;
    }


    /**
     * Get Selected Variants
     * */
    function selectedVariants() {
         selectedValues = [];

        $('.variantPrice:checked').each(function() {
            let value = $(this).val();
            if (!selectedValues.includes(value)) {
                selectedValues.push(value);
            }
        });


        getVariationKeyPrice();
    }


    $(document).on("click", ".variantPrice", function() {
        // Update the selected variants
        selectedVariants();

        addActiveClass();
    });

    function addActiveClass() {
        $('.variantPrice').removeClass('active');

        selectedValues.forEach(function(value) {

            $('#attributeValueId_' + value).css({'border':'1px solid #ddd' });
        })

    }

    /**
     * Collection Variation Key & Price
     * */
    function getVariationKeyPrice() {
        let productVariations = [];

        if (product && product !== 'null' && product !== 'undefined') {
            productVariations = product.attributes;
        }


        if (productVariations.length <= 0) {
            return false;
        }

        productVariations.forEach(element => {

            if (element.attributes_key == generate_variation_key()) {

                PRODUCT_SKU = element.sku;

                $(".productVariationId").val(element.id);

                let stockQty = element.stock.stock_qty;

                //only for general product / not campaign product
                $(".productVariationId").val(element.id);

                //only campaign product attribute
                if (element.campaign_product && element.campaign_product.campaign.is_valid_campaign) {

                    let campaign        = element.campaign_product.campaign;
                    let campaignProduct = element.campaign_product;


                    // Price
                    variation_price = campaignProduct.formatted_price;

                    // Price After Discount
                    variation_price_after_discount = campaignProduct.calculated_amount;

                    stockQty = campaignProduct.available_stock_qty;

                    discountCalculations();

                    // Remove d-none form flashSaleDiv class div
                    $(".flashSaleDiv").removeClass("d-none");

                    $(".campaignPercentageSpan").text(`${campaignProduct.discount_value}%`);

                    let soldPercentage = 0;
                    let perProductPercentage = 100 / campaignProduct.stock_qty;
                    let totalSold            = parseInt(campaignProduct.stock_qty - campaignProduct.available_stock_qty);
                    soldPercentage           = totalSold * perProductPercentage;

                    // Ends in
                    $(".campaignEndsIn").text(campaign.end_date_time);

                    // Assigned Qty
                    $(".campaignStockQtySpan").text(campaignProduct.stock_qty);

                    // Total Sold Qty
                    $(".availableStockQtySpan").text(totalSold);


                    $(".campaignProductProgressBar").css("width", `${soldPercentage}%`);
                } else {
                    // Add d-none to flashSaleDiv class
                    $(".flashSaleDiv").addClass("d-none");

                    variation_price = element.formatted_price;
                    variation_price_after_discount = element.calculated_amount;
                }


                updateSkuText();
                discountCalculations();
                addDisableAttributeToAddToCartBtn(stockQty, "productBodyAddToCart" + element.product_id);
            }
        });
    }


    function addDisableAttributeToAddToCartBtn(stockQty = 0, className = 'productBodyAddToCart') {
        if (stockQty <= 0) {
            $(`.${className}`).attr('disabled', true);
        } else {
            $(`.${className}`).removeAttr('disabled', true);
        }
    }

    function updateSkuText() {
        $(".productSku").text(PRODUCT_SKU);
    }

    /**
     * Calculate Discount
     * */
    function discountCalculations() {

        $('.sale-price').html(variation_price_after_discount);
        $('.discountVariantPrice').html(variation_price);
    }


    /**
     * ******************************************
     *       Product Variation Price End
     * ******************************************
     * */

    /**
     * ***************************************
     *      Shop Page Search Btn Start
     * ***************************************
     * */
    var shop_search = null;
    $(document).on("click", ".ShopPageSearchBtn", function(e) {
        // Search products
        searchProducts();
    });


    $(document).on("change", "#productFilterByOwner", function(e) {
        searchProducts();
    });
    /**
     * ***************************************
     *      Shop Page Search Btn End
     * ***************************************
     * */

    /**
     * ****************************************
     *          Shop Page Filter Start
     * ****************************************
     * */

    var shopMIN = 0;
    var shopMAX = 0;

    /* fireFilterRequest */
    $(document).on("click", ".fireFilterRequest", function() {
        searchProducts();
    });

 
    // Page Pagination
    var HAS_MORE_PAGE = false;
    var NEXT_PAGE_URL = null;

    function searchProducts(search = '', categoryId = '') {
        let queryString = `?search=${search}&category_id=${categoryId}`;
        let shopURL     = "{{ route('pos.shops') }}" + queryString;

        // Ajax Product Req URL
        ajaxProductReq(shopURL);
    }


    function skeletonNumbers(total = 1) {
        let skeletonHTML = "";
        for (var i = 1; i <= total; i++) {
            skeletonHTML += productSkeleton;
        }


        return skeletonHTML;
    }


    function ajaxProductReq(url) {
        loadingInContent(".posProducts");
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function(response) {
                // Show Load More Btn
                HAS_MORE_PAGE = response.optional.has_more_page;
                NEXT_PAGE_URL = response.optional.next_page_url;

                
                // Response Product Append.
                $(".posProducts").html(response.data);

                // Show Load More BTN
                showLoadMoreBtn();
            },
            error: function(err) {
                console.log("Error", err.responseJSON);
            }
        });
    }

    function ajaxProductReqLoadMore(url) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function(response) {
                // Show Load More Btn
                HAS_MORE_PAGE = response.optional.has_more_page;
                NEXT_PAGE_URL = response.optional.next_page_url;

                
                // Response Product Append.
                $(".posProducts").append(response.data);

                // Show Load More BTN
                showLoadMoreBtn();
            },
            error: function(err) {
                console.log("Error", err.responseJSON);
            }
        });
    }

    $(document).on("click", ".loadMoreProducts", function(e) {
        if (NEXT_PAGE_URL) {
            ajaxProductReqLoadMore(NEXT_PAGE_URL);
        }
    });


    // Show Add More Btn.
    function showLoadMoreBtn() {
        if (HAS_MORE_PAGE) {
            showElement(".loadMoreProducts");
        } else {
            hideElement(".loadMoreProducts");
        }
    }


    function consoleData(prefix = null) {

    }

    function createButton(text, forName) {


        return `<li class="list-inline-item me-1">
            <label class="badge bg-primary cursor-pointer rounded-pill lh-sm fw-normal" for=${forName}>
                ${text}<i class="bi bi-x ms-1"></i>
            </label>
        </li>`;
    }

    // Filters
    function selectedFilterShow(shopFilterObj) {
        let userFilterChoices = $(".userFilterChoices");

        userFilterChoices.html("");

        // Category Array
        appendButtonsToDiv(shopFilterObj.categoryIdsFor, shopFilterObj.categoryIdsNames);

        // Brand Array
        appendButtonsToDiv(shopFilterObj.brandIdsFor, shopFilterObj.brandIdsNames);

        // Attribute Values
        appendButtonsToDiv(shopFilterObj.attributeValuesFor, shopFilterObj.attributeValuesNames);
    }


    // Append buttons to the specified div
    function appendButtonsToDiv(array, forPrefix) {
        var $div = $(`.userFilterChoices`);

        array.forEach((forName, index) => {

            var label = $('label[for="' + forName + '"]');
            var labelText = label.text().trim(); // Remove leading/trailing spaces

            var buttonHtml = createButton(labelText, forName);

            $div.append(buttonHtml);
        });

        // cartInitFeather();
    }




    function debounceSearchProducts() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function() {
            searchProducts();
        }, 300);
    }

    function updateMinMaxText() {
        let showShopMIN = shopMIN * conversionRate;
        let showShopMAX = shopMAX * conversionRate;

        $("#result").html(`Min: ${showShopMIN} Max: ${showShopMAX}`);
    }

    function updateMinMax(min, max) {
        shopMIN = min;
        shopMAX = max;
    }
    /**
     * ****************************************
     *          Shop Page Filter End
     * ****************************************
     * */


    // Per Page.
    $(document).on("change", ".shopPagePerPage", function(e) {
        let perPage = $(this).val();

        searchProducts();
    });

    // Pay with Card Modal
    $(document).on("click", ".cardPay", function(e) {

        // Card Pay
        $("#payWithCardModal").modal("show");
    });

    // Make Radio Checked

    $(document).on('click', '.tt-custom-radio', function() {
        //TODO:: Active class will load here
    });

    /**
     * *******************************
     *      Price Range Slider
     * *******************************
     */

    var conversionRate = parseFloat("{{ getRate() }}");

    var debounceTimer; // Timer for debouncing


    var priceRangeSliderElement = document.getElementById("shopPriceRangeSlider");

    if (priceRangeSliderElement) {

        var newRangeSlider = new ZBRangeSlider("shopPriceRangeSlider");

        if (newRangeSlider) {
            // Update values and text live
            newRangeSlider.onChange = function(min, max) {
                updateMinMax(min, max);
                updateMinMaxText();

                // Debounce AJAX call
                debounceSearchProducts();
            };

            // Final call when user stops dragging
            newRangeSlider.didChanged = function(min, max) {
                updateMinMax(min, max);
                updateMinMaxText();
                searchProducts();
            };
        }
    }


    // Product Search
    searchProducts();


</script>
