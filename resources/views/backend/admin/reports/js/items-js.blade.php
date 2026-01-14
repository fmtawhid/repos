<script>
    "use strict";
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.reports.items') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }
    $('body').on('click', '#searchBtn', function() {
        var date_range = $('#date_range').val();
        // item_name        
        let item_name = $('#item_name').val();

        gFilterObj.date_range  = date_range;
        gFilterObj.item_name     = item_name;
        loadingInTable("tbody",{
            colSpan: 5,
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
        var url = "{{ route('admin.reports.items.export') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        // add export flag in case server wants it
        if (url.indexOf('?') === -1) url += '?export=1'; else url += '&export=1';
        window.open(url, '_blank');
    });

    getDataList();
</script>