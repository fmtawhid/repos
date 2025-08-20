<script>
    "use strict";
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.reports.items_category') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }
    $('body').on('click', '#searchBtn', function() {
        var date_range = $('#date_range').val();
        var user_id = $('#user_id :selected').val();
        var template_id = $('#template_id :selected').val();

        gFilterObj.date_range  = date_range;
        gFilterObj.user_id     = user_id;
        gFilterObj.template_id = template_id;
        loadingInTable("tbody",{
            colSpan: 5,
            prop: false,
        });

        if (gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }

        getDataList();
    });
    getDataList();
</script>