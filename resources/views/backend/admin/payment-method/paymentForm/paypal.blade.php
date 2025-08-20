 <form action="{{ route('admin.payment-gateways.store') }}" class="paymentForm" id="paypalPaymentForm" method="POST" enctype="multipart/form-data">
    @method('POST') 
    @csrf
     <div class="offcanvas offcanvas-end" id="offcanvasPaypal" tabindex="-1">
         <div class="offcanvas-header border-bottom py-3">
             <h5 class="offcanvas-title">{{ localize('Paypal Configuration') }}</h5>
             <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                 <i data-feather="x"></i>
             </span>
         </div>
         <x-common.splitter />
         <div class="offcanvas-body">

             <input type="hidden" name="payment_method" value="paypal">
             <div class="mb-3">
                 <label for="PAYPAL_CLIENT_ID" class="form-label">{{ localize('Paypal Client ID') }}</label>
                 <input type="text" id="PAYPAL_CLIENT_ID" name="types[PAYPAL_CLIENT_ID]" class="form-control"
                     value="{{ paymentGatewayValue('paypal', 'PAYPAL_CLIENT_ID') }}">
             </div>
             <div class="mb-3">
                 <label for="PAYPAL_CLIENT_SECRET" class="form-label">{{ localize('Paypal Client Secret') }}</label>
                 <input type="text" id="PAYPAL_CLIENT_SECRET" name="types[PAYPAL_CLIENT_SECRET]" class="form-control"
                     value="{{ paymentGatewayValue('paypal', 'PAYPAL_CLIENT_SECRET') }}">
             </div>

             <div class="mb-3">
                 <label class="form-label">{{ localize('Enable Paypal') }}</label>
                 <select id="enable_paypal" class="form-control select2" name="is_active" data-toggle="select2">
                     <option value="0" {{ paymentGateway('paypal')?->is_active == '0' ? 'selected' : '' }}>
                         {{ localize('Disable') }}</option>
                     <option value="1" {{ paymentGateway('paypal')?->is_active == '1' ? 'selected' : '' }}>
                         {{ localize('Enable') }}</option>
                 </select>
             </div>


             <div class="mb-3">
                 <label class="form-label">{{ localize('Gateway') }} <span><small>Sandbox/Live</small></span></label>
                 <select id="paypal_type" class="form-control select2" name="payment_type" data-toggle="select2">
                     <option value="sandbox" {{ paymentGateway('paypal')?->type == 'sandbox' ? 'selected' : '' }}>
                         {{ localize('Sandbox') }}</option>
                     <option value="live" {{ paymentGateway('paypal')?->type == 'live' ? 'selected' : '' }}>
                         {{ localize('Live') }}</option>
                 </select>
             </div>
         </div>
         <div class="offcanvas-footer border-top">
             <div class="d-flex gap-3">
                  <x-form.button  id="frmActionBtn"  class="paymentFormSubmitButton">{{ localize('Save Configuration') }}</x-form.button>
                

                 <x-form.button color="secondary" data-bs-dismiss="offcanvas">{{ localize('Close') }}</x-form.button>
             </div>
         </div>
     </div>
 </form>
