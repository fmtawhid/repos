<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.subscribers.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';

        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    $('body').on('click', '#searchBtn', function() {
        var search = $('#f_search').val();
        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });
        gFilterObj.search = search;
        getDataList();
    });
    getDataList();
</script>
