<script>
    'use strict';

    // load menus
    function getDataList() {
        var callParams      = {};
        callParams.type     = "GET";
        callParams.dataType = "html";
        callParams.url      = "{{ route('reservationmanager.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
        callParams.data     = '';
        ajaxCall(callParams, function (result) {
            $('tbody').empty().html(result);
            feather.replace();
        }, function onErrorData(err, type, httpStatus) {});
    }

    //----------------------------------------------------
    // search and filter reservation..
    //----------------------------------------------------
    $('body').on('click', '#searchBtn', function(e){
        e.preventDefault();
        var search      = $('#f_search').val();
        var status_id   = $('#status_id :selected').val();

        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
    

        loadingInTable("tbody",{
            colSpan: 11,
            prop: false,
        });

        gFilterObj.search       = search;
        gFilterObj.status_id    = status_id;
        gFilterObj.start_date   = start_date;
        gFilterObj.end_date     = end_date;

        if(gFilterObj.hasOwnProperty('page')) {
            delete gFilterObj.page;
        }

        getDataList();
    });


    // change Branch and call reservation table list 
    $(document).on('change', '.changeBranch', function() {
        loadingInContent('.showLoader', 'loading..');
        // reset table list
        $('.reservation_table_list').html("");


        var branchId = $(this).val();
        if (!branchId) {
            alert("Please select a branch");
            return;
        }
        $.ajax({            
            url: "{{ route('reservationmanager.area_list_by_branch_id', ['branch_id' => ':branch_id']) }}".replace(':branch_id', branchId),
            type: "GET",
            data: {
                branchId: branchId
            },
            success: function(response) {
                resetLoading('.showLoader', '');                

                // reset area list
                $('.getAreaList').html('');

                var options = '';
                options += '<option value="">' + 'Select Area' + '</option>'
                $.each(response.data, function(index, area) {
                    options += '<option value="' + area.id + '">' + (area.name ?? '') + ' (' + (area.number_of_tables ?? '0') + ' Tables)' + '</option>';
                });
                $('.getAreaList').html(options);
            },
            error: function(err) {
                resetLoading('.showLoader', '');
                alert('An error occurred. Please try again.');
            }
        });
    });


    // change Area and call table list 
    $(document).on('change', '.changeArea', function() 
    {
        var areaId = $(this).val();

        if (!areaId) {
            alert("Please select an Area");
            return;

        }else{
            loadingInContent('.showLoader', 'loading..');

            $.ajax({
            url: "{{ route('reservationmanager.table_list_by_area_id', ['area_id' => ':area_id']) }}".replace(':area_id', areaId),
            type: "GET",
            data: {
                areaId: areaId
            },
            success: function(response) {
                resetLoading('.showLoader', '');

                console.log('response data', response.data);

                if (!response.status) {
                    alert('An error occurred. Please try again.');
                    return;
                }

                // reset table list
                $('.reservation_table_list').html("");
                response.data.forEach(function(table) {
                    let tableItem = `                        
                        <div class="col">
                            <div data-id="${table.id}" class="makeTableSelected tt-table-item bg-light-subtle border rounded-3 p-2 cursor-pointer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Table Code: ${ table.table_code ?? ''}</h6>
                                    <span class="badge bg-success rounded-pill">${table.is_active ? 'Available' : 'Unavailable'}</span>                                    
                                </div>
                                <div class="p3">
                                    <p class="mb-0">Total Seats: ${table.number_of_seats ?? 0} </p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('.reservation_table_list').append(tableItem);
                    
                    initQrCode();
                });                
            },
            error: function(xhr, status, error) {
                resetLoading('.showLoader', '');
                alert('An error occurred. Please try again.');
            }
        });
        }
        
    });

    $(document).on('click', '.makeTableSelected', function() {        
        $('.makeTableSelected').not(this).removeClass('border-success');
        $(this).toggleClass('border-success');

        // set selected table
        let tableId = $(this).data('id');
        $("#table_id").val(tableId); 
    });

        // add Branch
    $("#addReservationsFrm").submit(function(e) {
        e.preventDefault();

        resetFormErrors('form#addReservationsFrm');
        loading('#reservationBtn', 'Saving...');

        let id = $("#addReservationsFrm #id").val();

        var callParams  = {};
        callParams.type = "POST";
        callParams.url  = $("form#addReservationsFrm").attr("action");
        callParams.data = new FormData($('#addReservationsFrm')[0]);
        callParams.processData = false;
        callParams.contentType = false;

        ajaxCall(callParams, function (result) {
            resetLoading('#reservationBtn', 'Save & New');
            showSuccess(result.message);
           if(!id) {
                resetForm('form#addReservationsFrm');               
            }
            
            toast(result.message);
            
            setTimeout(() => {                
                window.location.href = "{{ route('reservationmanager.index') }}";
            }, 1000);

            // getDataList();
            // $('#addBranchSideBar').offcanvas('hide');

        }, function (err, type, httpStatus) {
            showFormError(err, '#addReservationsFrm');
            resetLoading('#reservationBtn', 'Save & New');
        });

        return false;
    });

    // change Menu's status
    $('body').on('click', '.changeReservationsStatus', function(){
        let menuId = parseInt($(this).data("id"));
        let status = parseInt($(this).data("status"));

        swConfirm({
            title: "Do you want to change the status?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = "admin/update-admin-status/"+menuId;
                callParams.data = {
                    id: menuId,
                    modelName: "city",
                    is_active: status ? 0 : 1,
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    showFormError(err, '#addReservationsFrm');
                });
            }
        });
    });


    $('body').on('click', '.deleteReservations', function(){        
        let menuId = parseInt($(this).data("id"));        
        swConfirm({
            title: "Do you want to delete this Reservation ?",
            confirmButtonText: "Yes",
            showDenyButton: true,
        }, (result) => {
            if (result.isConfirmed) {
                var callParams  = {};
                callParams.type = "POST";
                callParams.url  = $(this).data("url");
                callParams.data = {
                    id: menuId,
                    _method: $(this).data("method"),
                    _token : "{{ csrf_token() }}"
                };
                ajaxCall(callParams, function (result) {
                    toast(result.message);
                    getDataList();
                }, function (err, type, httpStatus) {
                    toast(err.responseJSON.message, 'error');
                    showFormError(err, '#addReservationsFrm');
                });
            }
        });
    });


   var offcanvasBottom = document.getElementById('offcanvasBottom')

    offcanvasBottom.addEventListener('hidden.bs.offcanvas', function() {
        var bsOffcanvas2 = new bootstrap.Offcanvas(secondoffcanvas)
        bsOffcanvas2.show()
    })
    getDataList();
</script>

<script>
    function initQrCode()
    {
        $('.print_qr_code').each(function(){
            var code = $(this).attr('data-qr_code');
            
            if(code){
                new QRCode(this, {
                    text: code,
                    width: 200,
                    height: 200,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
            }
        });
    }
</script>
{{-- end showing qr code--}}
