<script type="text/javascript">
    "use strict";
    //localize in one click
    function copyLocalizations() {
        $('#localization-table > tbody  > tr').each(function(index, tr) {
            $(tr).find('.value').val($(tr).find('.key').text());
        });
    }
    var localization_url = $('#localization_url').val();
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = localization_url + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function(result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }
    // search
    $('body').on('click', '#searchBtn', function() {
        var search = $('#f_search').val();
        var is_active = $('#f_is_active :selected').val();

        gFilterObj.search = search;
        loadingInTable("#tags-list",{
            colSpan: 5,
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
    getDataList();
    $("#translateForm").submit(function(e) {
        e.preventDefault();
        resetFormErrors('form#translateForm');
        loading('#frmActionBtn', 'Saving...');
        loading('.generateContents', 'Generating...');

        let id = $("#translateForm #id").val();
        let callParams = {};

        callParams.type = "POST";
        callParams.url = $("form#translateForm").attr("action");
        callParams.data = $("form#translateForm").serialize();

        ajaxCall(callParams, function(result) {
            resetLoading('#frmActionBtn', 'Save');
            toast(result.message) 
            getDataList();
        }, function(err, type, httpStatus) {
            console.log(err);
            resetLoading('#frmActionBtn', 'Save');
        });

        return false;
    });
</script>