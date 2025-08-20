{{-- <div class="row align-items-center">
               <div class="col-lg-12">
                   <div class="alert alert-warning alert-dismissible fade show mb-3"
                       role="alert">

                       <a href="https://writebot.themetags.com/documentation/#update-version"
                           target="_blank">{{ localize('here') }}</a>.
                   </div>
               </div>
           </div> --}}
<form action="{{ route('admin.systemUpdate.update-version') }}" method="POST"
      enctype="multipart/form-data">
    @csrf
    <div class="" id="section-2">
        <div class="mb-3">
            <label for="default_creativity"
                   class="form-label">{{ localize('Update File (Zip)') }}
                <span class="text-danger ms-1">*</span></label>


            <div class="file-drop-area file-upload text-center rounded-3">
                <input type="file" class="file-drop-input" name="updateFile"
                       id="json" />
                <div class="file-drop-icon ci-cloud-upload">
                    <i data-feather="image"></i>
                </div>
                <p class="text-dark fw-bold mb-2 mt-3">
                    {{ localize('Drop your files here or') }}
                    <a href="javascript::void(0);"
                       class="text-primary">{{ localize('Browse') }}</a>
                </p>
                <p class="mb-0 file-name text-muted">

                    <small>* {{ localize('Allowed file types: ') }} .zip
                    </small>


                </p>
            </div>
            @if ($errors->has('file'))
                <span class="text-danger">{{ $errors->first('file') }}</span>
            @endif
        </div>
        @if($is_purchase == false)
            @include('backend.admin.update.license_admin', ['submit'=>false])
        @endif

        <div class="d-flex align-items-center mt-4">
            <button class="btn btn-primary"
                    type="submit">{{ localize('Update Now') }}</button>
        </div>
    </div>

</form>