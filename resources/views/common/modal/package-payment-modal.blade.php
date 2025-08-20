
<div class="modal fade" id="packagePaymentModal" tabindex="-1" aria-labelledby="packagePaymentModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="packagePaymentModalLabel">{{ localize('Select Payment Method') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">

                <form action="{{ route('website.subscriptions.subscribe') }}" method="POST" class="payment-method-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="package_id" value="" class="payment_package_id">
                    <!-- Online payment gateway -->
                    @auth
                        <div class="row g-3">

                            <div class="col-md-12 mb-3">
                                <div class="form-check tt-checkbox">
                                    {{ localize('Your current active package will be expired and This Will be active.') }}
                                </div>
                            </div>
                        </div>
                    @endauth

                    <div class="online_payment" id="online_payment">
                        <div class="row g-3">
                            @if (count($payments) > 0)
                                @foreach ($payments as $method)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="tt-single-gateway text-center">
                                            <input type="radio"
                                                   class="tt-custom-radio"
                                                   name="payment_method"
                                                   @checked($method->id == appStatic()::OFFLINE_PAYMENT_GATEWAY_ID)
                                                   id="{{ $method->gateway }}" value="{{ $method->id }}"
                                                   required
                                            />
                                            <label class="tt-gateway-info card p-3 cursor-pointer flex-column h-100 {{ $method->gateway == appStatic()::OFFLINE_PAYMENT_METHOD ? 'oflinePayment' : ''}}"
                                                   for="{{ $method->gateway }}"  data-method="{{$method->gateway}}">
                                                <div class="tt-gateway-icon">
                                                    <img src="{{ asset($method->image) }}"
                                                         alt="{{ strtoupper($method->gateway) }}" class="img-fluid">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="submit"
                                class="btn btn-primary mt-4 px-5">{{ localize('Proceed') }}</button>
                    </div>

                    <!--payment -->
                    @include('frontend.common._offline_payment')
                </form>
            </div>
        </div>
    </div>
</div>
