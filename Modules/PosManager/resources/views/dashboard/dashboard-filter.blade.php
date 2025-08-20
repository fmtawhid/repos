<div class="row justify-content-between align-items-center g-2 mb-3">
    <div class="col-auto flex-grow-1">
        <h5 class="mb-0">{{ localize("All listed products") }} <small class="text-muted">(<span class="shopPageTotalProducts">0</span>)</small></h5>
    </div>
    <div class="col-auto">
        <div class="tt-search-box">
            <div class="input-group">
                <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                <x-form.input
                    class="form-control rounded-start w-100 shopPageSearch"
                    type="text"
                    name="product-search"
                    id="product-search"
                    placeholder="{{ localize('Ex. Item Title, License Name, License Code, Product Unit') }}"
                />
            </div>
        </div>
    </div>

    <div class="col-auto">
        <button class="btn btn-sm btn-primary ShopPageSearchBtn" type="button">{{ localize("Search") }}</button>
    </div>

    <div class="col-lg-12">
        <ul class="userFilterChoices p-0 mb-0"></ul>
    </div>
</div>
