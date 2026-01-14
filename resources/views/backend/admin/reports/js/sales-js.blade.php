<script>
    "use strict";
    function getDataList() {
        var callParams = {};
        callParams.type = "GET";
        callParams.dataType = "html";
        callParams.url = "{{ route('admin.reports.sales') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }
    $('body').on('click', '#searchBtn', function() {
        var date_range = $('#date_range').val();
        var search = $('#search').val();

        gFilterObj.date_range = date_range;
        gFilterObj.search = search;
        // ensure detailed/per-product mode
        gFilterObj.per_product = 1;

        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });

        if (gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }

        getDataList();
    });

    // Export handler
    $('body').on('click', '#exportBtn', function() {
        if (gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }
        // ensure export uses detailed/per-product mode
        gFilterObj.per_product = 1;
        var url = "{{ route('admin.reports.sales.export') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        if (url.indexOf('?') === -1) url += '?export=1'; else url += '&export=1';
        window.open(url, '_blank');
    });

    // set default per_product mode so initial load is detailed
    gFilterObj.per_product = 1;

    getDataList();
</script>