<div class="row g-3">
    @foreach ($paymentGateways as $paymentMethod)
        {{-- paypal --}}
        @if($paymentMethod->gateway == 'offline')
            <h4>{{ localize('Offline Payment Method') }}</h4>
        @endif
        <div class="col-lg-3 col-md-6">
            <div class="tt-payment-gateway rounded-3 shadow-sm card border-0 h-100 flex-column cursor-pointer"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvas{{ ucfirst($paymentMethod->gateway) }}">
                <div class="card-body tt-payment-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <img class="img-fluid" src="{{ asset($paymentMethod->image) }}" alt="avatar" />
                        <div class="form-check form-switch mb-0">
                            <input type="checkbox" class="form-check-input"
                                @if ($paymentMethod->is_active == 1) checked @endif>
                        </div>
                    </div>
                    <div class="tt-payment-setting position-absolute btn rounded-pill btn-light">
                        {{ localize('Settings') }}<i data-feather="arrow-right" class="ms-1"></i>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


