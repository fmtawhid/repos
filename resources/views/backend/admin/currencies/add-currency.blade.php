<form action="{{ route('admin.currencies.store') }}" method="POST" id="addCurrencyForm">
    <div class="offcanvas offcanvas-end" id="addCurrencyFormSidebar" tabindex="-1">
        @method('POST')
        @csrf
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">{{ localize('Add New Currency') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Currency Name') }}" isRequired=true />
                <x-form.input name="name" id="name" type="text" placeholder="{{ localize('Name') }}"
                    value="" showDiv=false />
            </div>
            <div class="mb-3">
                <x-form.label for="symbol" label="{{ localize('Currency Symbol') }}" isRequired=true />
                <x-form.input name="symbol" id="symbol" type="text" placeholder=""
                    value="" showDiv=false />
            </div>
            <div class="mb-3">
                <x-form.label for="code" label="{{ localize('Currency Code') }}" isRequired=true />
                <x-form.input name="code" id="code" type="text" placeholder=""
                    value="" showDiv=false />
            </div>
           
            <div class="mb-3">
                <x-form.label for="rate" label="{{ localize('Rate ( 1 USD = ? )') }}" isRequired=true />
                <x-form.input name="rate" id="rate" type="text" placeholder=""
                    value="" showDiv=false />
            </div>


            <div class="mb-3">
                <x-form.label for="alignment" label="{{ localize('Alignment') }}" />
                <x-form.select name="alignment" id="alignment" class="">
                    <option value="0">{{ localize('[symbol][amount]') }}
                    </option>
                    <option value="1">{{ localize('[amount][symbol]') }}
                    </option>
                    <option value="2">{{ localize('[symbol] [amount]') }}
                    </option>
                    <option value="3">{{ localize('[amount] [symbol]') }}
                    </option>
                </x-form.select>
            </div>
            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Is Active') }}" />
                <x-form.select name="is_active" id="is_active">
                    <option value="1">
                        {{ localize('Yes') }}
                    </option>
                    <option value="0">
                        {{ localize('No') }}
                    </option>
                    
                </x-form.select>
            </div>
        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="frmActionBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
