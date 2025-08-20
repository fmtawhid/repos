@section("updateActiveStatus")
    <script>
        'use strict';

        window.releaseForServerRequest = true;

        $(document).on("click",".changeStatus",async function (e){

            let $el = $(this);

            let currentChecked = $el.prop("checked");
            let route = $(this).attr("data-route");

            let isChecked = $(this).attr("checked");

            await $.ajax({
                method  : "POST",
                url     : route,
                dataType: "JSON",
                success : function (response){

                    let isActive = response.data.is_active;

                    // Update Status true or false
                    $(this).prop('checked', isActive);

                    toast(response.message);
                    window.releaseForServerRequest = true
                },
                error : function (XHR, status, error){

                    $el.prop("checked", !currentChecked);

                    toast(XHR.responseJSON.message,"error");

                    window.releaseForServerRequest = true
                }
            });
        });
    </script>
@endsection
