<script>
    'use strict';

    // load users
    function getDataList() {
        var callParams = {};
        callParams.type = "GET";
        callParams.dataType = "html";
        callParams.url = "{{ route('admin.plan-histories.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data = '';
        // loadingInContent("#history-list", 'loading..');
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }
    getDataList();
    // search
    $('body').on('click', '#searchBtn', function(e) {
        e.preventDefault();
        loadingInTable("#history-list",{
            colSpan: 11,
            prop: false,
        });
        var search = $('#f_search').val();
        var is_active = $('#f_is_active :selected').val();
        var subscription_plan_id = $('#f_plan :selected').val();

        gFilterObj.search = search;
        gFilterObj.subscription_plan_id = subscription_plan_id;

        if (is_active === '0' || is_active === '1') {
            gFilterObj.is_active = is_active;
        } else if (gFilterObj.hasOwnProperty('is_active')) {
            delete gFilterObj.is_active;
        }

        if (gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }
        getDataList();
    });
</script>
