<script src="{{ asset('assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/footable.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/summernote-lite.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/summernote-image-attributes.js') }}"></script>
<script src="{{ asset('assets/js/vendors/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/basictable.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/prism.js') }}"></script>
<script src="{{ asset('assets/js/vendors/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/sweetalert2@11.js') }}"></script>
<script src="{{ asset('assets/js/vendors/jquery-resizable.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/jquery-resizableTableColumns.min.js') }}"></script>
<script src="{{ asset('assets/libs/codemirror/js/codemirror.min.js')}}"></script>
<script src="{{ asset('assets/libs/codemirror/js/javascript.min.js')}}"></script>
<script src="{{ asset('assets/js/markdown-it.min.js')}}"></script>

{{-- for qr code.. --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>


<script>
    "use strict";

    $('form').on('reset', function () {
        // Wait a bit to let browser reset select first
        setTimeout(function () {
            $('.select2').each(function () {
                $(this).val('').trigger('change'); // or set to default
            });
        }, 0);
    });

    $(() => {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            },
        });
    });
    var TT = TT || {};
    TT.baseUrl = '{{ \Request::root() }}';

</script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    'use strict';


    window.releaseForServerRequest = true;

    function initFeather(){
        feather.replace();
    }

    /**
     * Global function to update active status
     * */
    $("body").on("click", ".changeDataStatus", function() {
        let recordId = $(this).data("id");
        let model = $(this).data("model");

        swConfirm({
                title: "{{ localize('Do you want to change the status?') }}",
                confirmButtonText: "Yes",
                showDenyButton: true,
            },
            (result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append("id", recordId);
                    formData.append("model", model);
                    formData.append("_token", "{{ csrf_token() }}");

                    var callParams = {};
                    callParams.type = "POST";
                    callParams.contentType = false;
                    callParams.processData = false;
                    callParams.url = "{{ route('admin.status.update') }}";
                    callParams.data = formData;

                    ajaxCall(
                        callParams,
                        function(result) {
                            toast(result.message);
                            if ($.isFunction($.fn.getDataList)) {
                                getDataList();
                            }
                        },
                        function(err, type, httpStatus) {
                            let msg = err.responseJSON.message ??
                                "{{ localize('Failed to change the status') }}";
                            toast(msg, "error");
                        }
                    );
                }
            }
        );
    });

    window.releaseForServerRequest = true;



    /**
     * Global function to update user balance
     *
     * incoming Params calculation_type, platform
     * Here, calculation_type contains article_contents,chat_contents,image_contents
     * Here, platform contains openai,azure,googleTTS,elevenLabs
     *
     * Will Return a json response about Balance Summary
     * */
    async function updateUserBalanceAfterGenerateContent(
        calculation_type = "articles",
        platform = "openai"
    ) {

        await $.ajax({
            type: "POST",
            url: "{{ route('admin.users.updateBalance') }}",
            data: {
                calculation_type: calculation_type,
                platform: platform,
                _token: "{{ csrf_token() }}"
            },
            dataType: "JSON",
            success: function(result) {
                $('#balance-render').html(result.data);
                toast(result.message);
            },
            error: function(err, type, httpStatus) {
                const errorMsg = err?.responseJSON;
                console.log("Error ", errorMsg, errorMsg.message, " Errors : ", errorMsg.errors);
            }
        });
    }

    /**
     * Global function for Delete Record.
     * */
    $(document).on("click", ".erase", function(e) {
        e.preventDefault();

        let url      = $(this).attr("data-url");
        let id       = $(this).attr('data-id');
        let method   = $(this).data('method') ?? "DELETE";
        // let callback = $(this).data('callback') ? window[callback] : "";

        let _this = $(this);

        deleteData(_this);

    });

    // params: , ["Param 1", "Param 2"]
    function deleteData(_this, callback = "", params = []) {
        let url    = _this.attr("data-url");
        let id     = _this.attr('data-id');
        let method = _this.data('method') ?? "DELETE";

        Swal.fire({
            title: "<?= localize('Are you sure you want to proceed?') ?>",
            text: '<?= localize('This action will permanently delete the selected record.') ?> ',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: '<?= localize('Yes, Delete') ?>',
        }).then((result) => {
            if (result.isConfirmed) {
                let callParams = {};
                callParams.type = method;
                callParams.url = url;
                callParams.data = {
                    id: id,
                    _token: "{{ csrf_token() }}",
                    _method: method,
                };
                callParams.dataType = "JSON";

                ajaxCall(
                    callParams,
                    function(result) {
                        toast(result.message);
                        $(_this).closest("tr").remove();
                        $("#" + id).remove();

                        if(callback) {
                            callback.apply(this, params);
                        }

                    },
                    function(err, type, httpStatus) {
                        window.releaseForServerRequest = true;
                        const errorMsg = err?.responseJSON?.message;
                        toast(errorMsg, "error");
                    }
                );
            }
        });
    }

    function showChatLoader(isShow = false) {
        let chatLoader = $(".chatLoader");

        isShow ? chatLoader.html(loaderHTML()) : chatLoader.html(null);
    }

    function loaderHTML() {
        let expertImg = "{{ asset('assets/img/avatar/1.jpg') }}";

        return `<div class="d-flex justify-content-start mt-4 tt-message-wrap chatLoader">
        <div class="d-flex flex-column align-items-start">
            <div class="d-flex align-items-start">
                <div class="avatar avatar-md flex-shrink-0">
                    <img class="rounded-circle" src="${expertImg}" alt="avatar" />
                </div>
                <div class="ms-3 p-2 rounded-3 text-start mw-450 tt-message-text ">
                    <!-- text preloader start -->
                    <!-- add tt-loader tt-loader-sm for small size -->
                    <div class="tt-loader tt-loader-sm">
                        <span class="tt-loader-bar-1"></span>
                        <span class="tt-loader-bar-2"></span>
                        <span class="tt-loader-bar-3"></span>
                        <span class="tt-loader-bar-4"></span>
                        <span class="tt-loader-bar-5"></span>
                    </div>
                    <!-- text preloader end -->
                </div>
            </div>

        </div>
    </div>`;
    }

    function expertBody() {
        let expertImg = "{{ asset('assets/img/avatar/1.jpg') }}";

        return `<div class="d-flex justify-content-start mt-4 tt-message-wrap">
            <div class="d-flex flex-column align-items-start">
                <div class="d-flex align-items-start">
                    <div class="avatar avatar-md flex-shrink-0">
                        <img class="rounded-circle"
                                loading="lazy"
                                src="${expertImg}"
                                alt="avatar"
                        />
                    </div>
                    <div class="ms-3 p-3 rounded-3 text-start mw-650 tt-message-text aiResponseBox">
                    </div>
                </div>
            </div>
        </div>`;
    }
    // change language
    function changeLocaleLanguage(e) {
        var locale = e.dataset.flag;
        $.post("{{ route('backend.changeLanguage') }}", {
            _token: '{{ csrf_token() }}',
            locale: locale
        }, function(data) {
            setTimeout(() => {
                location.reload();
            }, 300);
        });
    }

    // change currency
    function changeLocaleCurrency(e) {
        var currency_code = e.dataset.currency;
        $.post("{{ route('backend.changeCurrency') }}", {
            _token: '{{ csrf_token() }}',
            currency_code: currency_code
        }, function(data) {
            setTimeout(() => {
                location.reload();
            }, 300);
        });
    }
    // getPackageTemplates
    function getPackageTemplates(plan_id, type = null) {
        $('.package-template-contents').empty();

        console.log(type);
        var data = {
            plan_id, type
        }
        var callParams = {};
        callParams.type = "GET";
        callParams.dataType = "html";
        callParams.url = "{{ route('subscriptions.getPackageTemplates') }}";
        callParams.data = data;
        loadingInContent('.package-template-contents', 'loading...');
        ajaxCall(callParams, function(result) {
            $('.package-template-contents').html(result);
        }, function onErrorData(err, type, httpStatus) {});

    }

    function toggleGroupAll($this) {
        $($this).parent().parent().parent().parent().find("input:checkbox").prop('checked', $this
            .checked);
    }

    // localize data
    function localizeData(langKey) {
        window.location = '{{ url()->current() }}?lang_key=' + langKey + '&localize';
    }
            // flatpickr
    $(".date-picker").each(function(el) {
        var $this = $(this);
        var options = {
                dateFormat: 'm/d/Y'
        };

        var date = $this.data("date");
        if (date) {
            options.defaultDate = date;
        }

        $this.flatpickr(options);
    });

    $(".date-range-picker").each(function(el) {
        var $this = $(this);
        var options = {
            mode: "range",
            showMonths: 2,
            dateFormat: 'm/d/Y'
        };

        var start = $this.data("startdate");
        var end = $this.data("enddate");

        if (start && end) {
            options.defaultDate = [start, end];
        }

        $this.flatpickr(options);
    });

    $(document).on("change",".updateUserBranch", function (e){

       let branchId = $(this).val();

       let callParams = {};

       callParams.type = "post"
       callParams.url  = "{{ route('admin.info-update') }}";
       callParams.data = {
           _token : "{{ csrf_token() }}",
           branch_id : branchId,
           purpose : "branch_id_update"
       };

       callParams.dataType = "json";

       ajaxCall(callParams, function (response){

           console.log("Server Response : ", response);
           window.location.reload();
       }, function(err){

          toast(err.responseJSON.message, "error");
       });
    });
</script>

@include("commonJs.copy-js")

@stack('scripts')
