<script src="{{ urlVersion('dashboardFiles/js/vendors/select2.min.js') }}"></script>

<script>
    'use strict'

    $(()=>{
        // $(".select2").select2({
        //     maximumSelected : null
        // });

        initSelect2();
    })

    function initSelect2(){
        $(".select2Tag").each(function () {
            $(this).select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });
    }
</script>
