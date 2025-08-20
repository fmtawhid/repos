<script>
    "use strict";
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.reports.teams') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }
    $('body').on('click', '#searchBtn', function() {
        var date_range = $('#date_range').val();
        var branch_id = $('#branch_id :selected').val();
        var status_id = $('#status_id :selected').val();
        

        gFilterObj.date_range  = date_range;
        gFilterObj.branch_id   = branch_id;
        gFilterObj.status_id   = status_id;
        
        loadingInTable("tbody",{
            colSpan: 19,
            prop: false,
        });

        if (gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }

        getDataList();
    });
    getDataList();
</script>