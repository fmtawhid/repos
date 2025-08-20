<script>
    "use strict";

    const LOAD_PRODUCTS   = "{{ route('pos.index') }}?loadProducts=true";
    const LOAD_CATEGORIES = "{{ route('pos.index') }}?loadCategories=true";

    function loadCategories(){
        $.ajax({
            url: LOAD_CATEGORIES,
            type: "GET",
            success: function (response) {
                $(".posCategories").append(response);
            },
            error: function (error) {
                console.log("Load Categories ",error);
            }
        });
    }

    function getPosProducts(search = null){
        loadingInContent(".posModalResult", "Loading Products...");

        ajaxCall({
            url: `${LOAD_PRODUCTS}&search=${search}`,
            type: "GET",
            dataType: "html"
        }, function (response) {

            $(".posModalResult").html(response);

            initFeather();
        }, function (error) {
            console.log("Error",error,error.responseJSON);
        });
    }

    // POS Search
    $(document).on("keyup", "#posProductSearchBtn", function () {
        let search = $(this).val();

        getPosProducts(search);
    });

    // posBtnSearch
    $(document).on("click", "#posProductSearchBtn", function () {

        let search = $("#posProductSearchBtn").val();

        getPosProducts(search);
    });


</script>
