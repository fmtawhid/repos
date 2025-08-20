<script src="{{ urlVersion('dashboardFiles/js/sweetalert.min.js') }}"></script>


<script>
    'use Strict'

    var reloadAfterDelete = false;
    $(document).on("click",".erase",function (e){
        e.preventDefault();

        let url = $(this).attr("data-href") ?? $(this).attr("data-url");
        let id  = $(this).attr('data-id'); // $(this).data('id');
        let method =  $(this).data('method');

        let reloadRequired = $(this).data('reload');

        if(reloadRequired){
            reloadAfterDelete = reloadRequired;
        }

        console.log("Main URL : ", url);

        let element = $(this);

        Swal.fire({
            title:"<?=  localize("Are you sure you want to proceed?.") ?>" ,
            text: '<?=  localize("This action will permanently delete the selected record.") ?> ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?=  localize('Yes, Delete') ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                dynamicDeleteMethod(url, id, method, element);
            }
        })

    })

    /**
     * incomingParameters first Delete URL, second Row ID, Third Method
     * */
    async function dynamicDeleteMethod(url, id, method, element){

        const token = "{{ csrf_token() }}";
        const payloads = {
            _token  : token,
            _method : method,
            id      : id
        };
        await $.ajax({
            method : "POST",
            url : url,
            data : payloads,
            dataType : "JSON",
            success:function (res) {
                Swal.fire(
                    '<?=  appStatic()::MESSAGE_DELETE_SUCCESS_POP_UP ?>',
                    res.message,
                    'success'
                )

                $(element).closest("tr").remove();

                if(reloadAfterDelete){
                    setTimeout(function () {
                        window.location.reload();
                    },300)
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                let errorResponse = xhr.responseJSON;


                Swal.fire(
                    thrownError,
                    errorResponse.message,
                    'error'
                )
            }
        });
    }
</script>
