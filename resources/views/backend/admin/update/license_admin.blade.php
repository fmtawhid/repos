@php
    $submit = isset($submit) ? $submit :false;
@endphp
<div class="row align-items-center mt-4" id="license_div">
    <div class="col-lg-5">
        <x-form.label
                for="purchase_code"
                class="form-label"
                isRequired="true"
                label="Purchase Code"
        />

        <x-form.input
                class="form-control"
               type="text"
               id="purchase_code"
               name="purchase_code"
               placeholder=""
               value="{{ old('purchase_code') }}"
               required
        />
        <x-error :name="'purchase_code'" />

    </div>

    <div class="col-lg-3">
        <label class="form-label">{{ localize('Server Mode') }}<span
                    class="text-danger ms-1">*</span> <span class="ms-1 cursor-pointer"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-title="{{ localize('Insert -1 to make it unlimited') }}"><i
                        data-feather="help-circle" class="icon-14"></i></span></label>
        <select class="select2 form-control package_select" data-toggle="select2" name="server_mode" required>
            <option value="production">{{ localize("Production") }}</option>
            <option value="local">{{ localize("Development") }}</option>
        </select>

    </div>
    @if($submit == true)
        <div class="col-lg-3">
            <button class="btn btn-primary mt-4" type="submit" id="licesne_submit">
                <i data-feather="save" class="me-1"></i> {{ localize('Save') }}
            </button>
        </div>
    @endif
</div>
<small>
    <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">
        {{ localize("How to collect purchase code") }} ?
    </a>
</small>