<div class="col-12 col-lg-8">
    <div class="card border rounded-3 p-3 tt-pos-left h-100 d-flex flex-column">
        @include("posmanager::dashboard.left.search-form")

        <div class="tt-pos-products-wrap">

            @include("posmanager::dashboard.left._left_categories")
            @include("posmanager::dashboard.left._left_products")

        </div>
    </div>
</div>
