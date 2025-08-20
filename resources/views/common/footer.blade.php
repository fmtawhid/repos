<!--footer section start-->
<footer class="tt-footer py-3 mt-auto bg-light-subtle">
    <div class="container">
        <div class="row g-3 align-items-center flex-wrap justify-content-between justify-content-center">
            <div class="col-md-4">
                <div class="copyright">
                    <p class="fs-md mb-0">
                        {!! html_entity_decode(getSetting('copywrite_text')) !!}
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                 <p class="mb-0 text-md-end">{{localize('Version')}}: <strong> {{getSetting('app_version') ?? env('APP_VERSION')}} </strong></p>
            </div>
        </div>
    </div>
</footer> <!--footer section end-->
