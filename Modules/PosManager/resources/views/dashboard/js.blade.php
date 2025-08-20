<script>
    "use strict";

    const LOAD_PRODUCTS   = "{{ route('pos.dashboard') }}?loadProducts=true";
    const LOAD_CATEGORIES = "{{ route('pos.dashboard') }}?loadCategories=true";
    const LOAD_TABLES = "{{ route('pos.dashboard') }}?loadTables=true";
    const LOAD_EMPLOYEES = "{{ route('pos.dashboard') }}?loadBranchEmployees=true";
    const LOAD_CUSTOMERS = "{{ route('pos.dashboard') }}?loadVendorCustomers=true";

    $(() =>{
        //Categories
        loadCategories();

        // Load Tables
        loadTables();

        // Load Employees
        loadBranchEmployees();

        // Load customers
        loadVendorCustomers();
    });

    function loadCategories(){
        $.ajax({
            url: LOAD_CATEGORIES,
            type: "GET",
            dataType:"html",
            success: function (response) {
                $(".posCategories").append(response);
            },
            error: function (error) {
            }
        });
    }

    function getNextPosProducts(){

    }

 

    // POS Search
    $(document).on("keyup", "#posProductSearchBtn", function () {
        let search = $(this).val();

        searchProducts(search);
    });

    // posBtnSearch
    $(document).on("click", "#posProductSearchBtn", function () {

        let search = $("#posProductSearchBtn").val();

        searchProducts(search);
    });

    // Pos Tab Slider
    const posSliders = document.querySelectorAll(".pos_slider");

    posSliders.forEach(posSlider => {
        new Swiper(posSlider, {
            loop: true,
            speed: 700,
            spaceBetween: 12,
            slidesPerView: 1,
            autoplay: false,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            breakpoints: {
                0: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 4
                },
                1310: {
                    slidesPerView: 5
                },
                1550: {
                    slidesPerView: 6
                },
                1800: {
                    slidesPerView: 7
                }
            }
        });
    });


    // Pos Delivery Type
    $(document).on("change", ".posDeliveryType", function () {
        let posDeliveryType = parseInt($(this).val()) ;

        if(posDeliveryType !== 1){
            $(".posSelectTable").addClass("d-none");
        }else{
            $(".posSelectTable").removeClass("d-none");
        }

    });

    // posSelectTable
    $(document).on("click", ".posSelectTable", function () {

        // modal show
        $(".posTableModal").modal("show");

        // Load Tables
        loadTables();
    });

    function loadTables(){

        loadingInContent(".posTableModal .modal-body", "Loading Products...");

        let selectedTableId = $("#posTableId").val();

        ajaxCall({
            url: `${LOAD_TABLES}`,
            type: "GET",
            dataType: "html"
        }, function (response) {

            $(".posTableModal .modal-body").html(response);

            initFeather();

            if(selectedTableId){
                let className = `.tableItem${selectedTableId}`;
                $(className).addClass("border-success");
            }
        }, function (error) {
        });
    }

    // pick table
    $(document).on("click", ".pickTable", function () {

        let tableId = $(this).attr("data-table_id");

        // set table id
        $("#posTableId").val(tableId);

        // modal hide
        $(".posTableModal").modal("hide");
    })

    /* POS Order Place Start */
    $(document).on("submit", ".posPlaceOrderFrm", function(e){

        // alert("Submit");
        e.preventDefault();

        var submitBtn = $(this).find("button[type='submit']");
        var originalHtml = submitBtn.html();

        submitBtn.prop("disabled",true).html("{{ localize('Processing...') }}");

        var form = $(this);

        let callParams  = {};
        callParams.type = "POST";
        callParams.url  = form.attr("action");
        callParams.data = new FormData(form[0]);
        callParams.processData = false;
        callParams.contentType = false;
        callParams.dataType = "json";

        ajaxCall(callParams, function (response){

            // Original btn content clone and paste
            submitBtn.prop("disabled",false).html(originalHtml);

            toast(response.message,"success");

            // make empty cart items

            // Load Cart Items
            updateCartElement(".posCartItems", null);

            // Sub-total
            updateCartElement(".posCartSubTotal", 0);

            // Tax
            updateCartElement(".posCartTax", 0);

            // Grand Total
            updateCartElement(".posCartGrandTotal", 0);

            // print
            let route = response.data.print_route
            printPosOrder(route);

        }, function (xhr, status, error){

            // Original btn content clone and paste
            submitBtn.prop("disabled",false).html(originalHtml);

            // show error toaster
            toast(xhr.responseJSON.message,"error");

            // show form error
            showFormError(xhr, "form.posPlaceOrderFrm");
        });
    });

    function updateCartElement(selector, data) {
        if ($(selector).length) {
            $(selector).empty().html(data);
        }
    }

    /* POS Order Place End  */


    /* New Order btn actions start */
    $(document).on("click", ".posNewOrder", function () {

        let callParams  = {};
        callParams.type = "post";
        callParams.url  = "{{ route('carts.deleteCarts',":id") }}".replace(':id', parseInt("{{ userId() }}"));
        callParams.data = {
            _token : "{{ csrf_token() }}"
        };

        callParams.dataType = "json";

        ajaxCall(callParams, function (result) {
            toast(result.message);

            // Load Cart Items
            updateCartElement(".posCartItems", null);

            // Sub-total
            updateCartElement(".posCartSubTotal", 0);

            // Tax
            updateCartElement(".posCartTax", 0);

            // Grand Total
            updateCartElement(".posCartGrandTotal", 0);

        }, function (err, type, httpStatus) {

            toast(err.responseJSON.message, "error");
        });
    });

    /* New Order btn actions end */

    function loadVendorCustomers(){

        ajaxCall({
            url: `${LOAD_CUSTOMERS}`,
            type: "GET",
            dataType: "html"
        }, function (response) {

            $(".posCustomers").html(response);
        }, function (error) {
        });
    }

    function loadBranchEmployees(){

        ajaxCall({
            url: `${LOAD_EMPLOYEES}`,
            type: "GET",
            dataType: "html"
        }, function (response) {

            $(".posBranchEmployees").html(response);
        }, function (error) {
        });
    }


    $(document).on("click", ".itemCategory", function () {
        let categoryId = $(this).attr("data-id");
        let keyword = $(".keyword").val();

        searchProducts(keyword,categoryId);
    })


    $(document).on("click", ".searchBtn", function () {
        let keyword = $(".keyword").val();

        searchProducts(keyword);
    })

    $(document).on("click", ".tt-single-pos-item", function () { 
        $(this).closest(".posProducts").find(".tt-single-pos-item").removeClass("active-item"); // remove active from all items
        $(this).addClass("active-item");
    })

    $(document).on("click", ".itemCategory", function () { 
        $(this).closest(".posCategories").find(".itemCategory").removeClass("border-primary"); // remove active from all items
        $(this).addClass("border-primary");
    })

    $(document).on("submit", ".orderReceiveForm", function (e) {
        e.preventDefault();
        
        var submitBtn = $(this).find("button[type='submit']");
        var originalHtml = submitBtn.html();

        submitBtn.prop("disabled",true).html("{{ localize('Processing...') }}");

        var form = $(this);

        let callParams  = {};
        callParams.type = "POST";
        callParams.url  = form.attr("action");
        callParams.data = new FormData(form[0]);
        callParams.processData = false;
        callParams.contentType = false;
        callParams.dataType = "json";

        ajaxCall(callParams, function (response){

            // Original btn content clone and paste
            submitBtn.prop("disabled",false).html(originalHtml);

            toast(response.message,"success");

            // resetForm("#orderReceiveForm")
            // $('#orderReceiveForm').find("input:text, input:number, input:password, input:file, select, textarea").val("");
            $("#orderCode").val("");
            $("#amount").val("");
            setTimeout(() => {
                $("#receivePayment").modal("hide");
            }, 300);
        }, function (xhr, status, error){

            // Original btn content clone and paste
            submitBtn.prop("disabled",false).html(originalHtml);

            // show error toaster
            toast(xhr.responseJSON.message,"error");

            // show form error
            showFormError(xhr, "form.orderReceiveForm");
        });
    })

</script>
