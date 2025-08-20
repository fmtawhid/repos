<div class="offline_payment d-none" id="offline_payment">
    <div class="row">

        <div class="col-md-12">
            <div class="mb-4">
                <label for="payment_method" class="form-label">{{ localize('Payment Method') }} <span
                        class="text-danger ms-1">*</span></label>
                <select class="form-control select2 offline_payment_method" id="offline_payment_method"
                    name="offline_payment_method" data-toggle="select2">
                    <option value="">{{ localize('Select Offline Payment Method') }}</option>
                    @foreach ($offlinePaymentMethods as $offlinePaymentMethod)
                        <option value="{{ $offlinePaymentMethod->id }}">
                            {{ $offlinePaymentMethod->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12">
            <div class="mb-4">
                <label for="name" class="form-label text-center all-description d-none">{{ localize('Description') }}
                    <span class="text-danger ms-1">*</span></label>
                @foreach ($offlinePaymentMethods as $offlinePaymentMethod)
                    <p id="description_{{ $offlinePaymentMethod->id }}" class="all-description d-none">
                        {!! nl2br(e($offlinePaymentMethod->description)) !!}</p>
                @endforeach
            </div>
        </div>

    </div>


    <div class="mb-4">
        <label class="form-label">{{ localize('Payment Details') }} <span class="text-danger ms-1">*</span></label>
        <textarea class="form-control" name="payment_detail" id="offline_payment_detail" rows="2"
            placeholder="{{ localize('Type your Payment Details') }}"></textarea>
        @if ($errors->has('payment_detail'))
            <span class="text-danger">{{ $errors->first('payment_detail') }}</span>
        @endif
    </div>

    <div class="mb-3">
        <label for="default_creativity" class="form-label">{{ localize('File') }}
        </label>


        <div class="file-drop-area file-upload text-center rounded-3">
            <input type="file" class="file-drop-input" name="file" id="offline_file" />
            <div class="file-drop-icon ci-cloud-upload">
                <i data-feather="image"></i>
            </div>
            <p class="text-dark fw-bold mb-2 mt-3">
                {{ localize('Drop your files here or') }}
                <a href="javascript::void(0);" class="text-primary">{{ localize('Browse') }}</a>
            </p>
            <p class="mb-0 file-name text-muted">

                <small>* {{ localize('Allowed file types: jpg,png,jpeg') }}
                </small>


            </p>
        </div>
        @if ($errors->has('file'))
            <span class="text-danger">{{ $errors->first('file') }}</span>
        @endif
    </div>
    <div class="mb-4">
        <label class="form-label">{{ localize('Note') }}</label>
        <textarea class="form-control" name="note" id="offline_note" rows="1"
            placeholder="{{ localize('Type your Note') }}"></textarea>
        @if ($errors->has('note'))
            <span class="text-danger">{{ $errors->first('note') }}</span>
        @endif
    </div>
    <div class="d-flex justify-content-between center">
        <button type="button" class="btn btn-secondary mt-4 px-5 cancel">{{ localize('Cancel') }}</button>
        <button type="submit" class="btn btn-primary mt-4 px-5">{{ localize('Proceed') }}</button>
    </div>

</div>
