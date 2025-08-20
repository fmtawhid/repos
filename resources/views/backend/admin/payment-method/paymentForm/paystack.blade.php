 <form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="paystackPaymentForm" method="POST"
     enctype="multipart/form-data">
     @csrf
     <div class="offcanvas offcanvas-end" id="offcanvasPaystack" tabindex="-1">
         <div class="offcanvas-header border-bottom py-3">
             <h5 class="offcanvas-title">{{ localize('Paystack Configuration') }}</h5>
             <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                 <i data-feather="x"></i>
             </span>
         </div>
         <x-common.splitter />
         <div class="offcanvas-body" data-simplebar>

             <input type="hidden" name="payment_method" value="paystack">

             <div class="mb-3">
                 <label for="PAYSTACK_PUBLIC_KEY" class="form-label">{{ localize('Paystack Public Key') }}</label>
                 <input type="text" id="PAYSTACK_PUBLIC_KEY" name="types[PAYSTACK_PUBLIC_KEY]" class="form-control"
                     value="{{ paymentGatewayValue('paystack', 'PAYSTACK_PUBLIC_KEY') }}">
             </div>

             <div class="mb-3">
                 <label for="PAYSTACK_SECRET_KEY" class="form-label">{{ localize('Secret Key') }}</label>
                 <input type="text" id="PAYSTACK_SECRET_KEY" name="types[PAYSTACK_SECRET_KEY]" class="form-control"
                     value="{{ paymentGatewayValue('paystack', 'PAYSTACK_SECRET_KEY') }}">
             </div>

             <div class="mb-3">
                 <label for="MERCHANT_EMAIL" class="form-label">{{ localize('Merchant Email') }}</label>
                 <input type="text" id="MERCHANT_EMAIL" name="types[MERCHANT_EMAIL]" class="form-control"
                     value="{{ paymentGatewayValue('paystack', 'MERCHANT_EMAIL') }}">
             </div>

             <div class="mb-3">
                 <label for="" class="form-label">{{ localize('Paystack Callback') }}</label>
                 <input type="text" id="" name="" class="form-control" disabled
                     value="{{ route('paystack.callback') }}">
             </div>

             <div class="mb-3">
                 <label for="PAYSTACK_CURRENCY_CODE"
                     class="form-label">{{ localize('Paystack Currency Code') }}</label>
                 <input type="text" id="PAYSTACK_CURRENCY_CODE" name="types[PAYSTACK_CURRENCY_CODE]"
                     class="form-control" value="{{ paymentGatewayValue('paystack', 'PAYSTACK_CURRENCY_CODE') }}">
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Enable Paystack') }}</label>
                 <select id="enable_paystack" class="form-control select2" name="is_active" data-toggle="select2">
                     <option value="0" {{ paymentGateway('paystack')?->is_active == '0' ? 'selected' : '' }}>
                         {{ localize('Disable') }}</option>
                     <option value="1" {{ paymentGateway('paystack')?->is_active == '1' ? 'selected' : '' }}>
                         {{ localize('Enable') }}</option>
                 </select>
             </div>

         </div>
         <div class="offcanvas-footer border-top">
             <div class="d-flex gap-3">
                  <x-form.button id="frmActionBtn" class="paymentFormSubmitButton">{{ localize('Save Configuration') }}</x-form.button>
                 <x-form.button color="secondary" data-bs-dismiss="offcanvas">{{ localize('Close') }}</x-form.button>
             </div>
         </div>
     </div>
 </form>
