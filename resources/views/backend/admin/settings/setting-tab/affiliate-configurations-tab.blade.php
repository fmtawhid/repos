<div class="card">
    <form action="{{ route('admin.settings.store') }}" method="POST" class="affiliate-settings-form settingsForm" enctype="multipart/form-data" id="affiliate-settings-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Affiliate Configurations Setting') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
                @csrf
                <div class="row g-3">
                    
                    <div class="col-md-12">                       
                        <x-form.label for="affiliate_commission" label="{{ localize('Affiliate Commission %') }}" isRequired=true />
                        <x-form.input name="settings[affiliate_commission]" id="affiliate_commission"
                                      type="text"
                                      placeholder=""
                                      value="{{ getSetting('affiliate_commission') }}"
                                      showDiv=false
                        />
                    </div>
                    <div class="col-md-12">                       
                        <x-form.label for="minimum_withdrawal_amount" label="{{ localize('Minimum Withdrawal Amount') }}" isRequired=true />
                        <x-form.input name="settings[minimum_withdrawal_amount]" id="minimum_withdrawal_amount"
                                      type="text"
                                      placeholder="{{ localize('Minimum Withdrawal Amount') }}"
                                      value="{{ getSetting('minimum_withdrawal_amount') }}"
                                      showDiv=false
                        />
                        <span class="text-muted fs-sm">*{{localize('withdraw amount calculate with')}} <strong>$</strong></span>
                    </div>
                    <div class="col-md-12">
                        <x-form.label for="enable_affiliate_continuous_commission"
                            label="{{ localize('Allow Commission Continuously') }}" />
                        <x-form.select name="settings[enable_affiliate_continuous_commission]" id="enable_affiliate_continuous_commission">
                            <option value="0"
                                {{ getSetting('enable_affiliate_continuous_commission') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                            <option value="1"
                                {{ getSetting('enable_affiliate_continuous_commission') == '1' ? 'selected' : '' }}>
                                {{ localize('Enable') }}</option>
                        </x-form.select>
                        <span class="text-muted fs-sm">*{{localize('If enabled, user will get commission for each subscriptions of referred user. Otherwise only for the first subscription.')}}</span>
                    </div>
                   
                    <div class="col-md-12">
                        <x-form.label for="affiliate_payout_payment_methods" label="{{ localize('Payout Payment Methods') }}" />
                        <x-form.select name="settings[affiliate_payout_payment_methods][]" class="select2" id="affiliate_payout_payment_methods" multiple>
                            @foreach ($paymentGateways as $key => $gateway)
                                <option value="{{ $gateway->gateway }}" {{in_array($gateway->gateway, $affiliatePaymentMethods) ? 'selected':''}}>{{ ucfirst($gateway->gateway) }}</option>
                            @endforeach
                        </x-form.select>
                    </div>
                    
                    <div class="col-md-12">
                        <x-form.label for="enable_affiliate_system" label="{{ localize('Enable Affiliate System') }}" />
                        <x-form.select name="settings[enable_affiliate_system]" id="enable_affiliate_system">
                            <option value="1" {{ getSetting('enable_affiliate_system') == '1' ? 'selected' : '' }}>
                                {{ localize('Enable') }}</option>
                            <option value="0" {{ getSetting('enable_affiliate_system') == '0' ? 'selected' : '' }}>
                                {{ localize('Disable') }}</option>
                        </x-form.select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-3">
            <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
        </div>
    </form>
</div>
