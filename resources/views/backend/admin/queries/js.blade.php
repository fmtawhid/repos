<script>
    'use strict';

    // load Template Categories
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('admin.queries.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    $('body').on('click', '#searchBtn', function() {
        var search = $('#f_search').val();

        var is_active = $('#f_is_active :selected').val();

        gFilterObj.search = search;
        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });

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

    // edit user
    $(document).on('click', '.markRead', function() {
        let userId = parseInt($(this).data("id"));
        let actionUrl = $(this).data("update-url");
        let editActionUrl = $(this).data("url");

        let callParams = {};
        callParams.type = "GET";
        callParams.url = editActionUrl;
        callParams.data = "";
        ajaxCall(callParams, function(result) {
                toast(result.message);
                getDataList();
            },
            function(err, type, httpStatus) {

            });
    });

    getDataList();
</script>
