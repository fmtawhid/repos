<div class="category_brand_tab">
    <ul
        class="nav nav-pills tt-horizontal-tab tt-prompt-group-list gap-2 nav-tabs-dropdown"
        id="pills-tab" role="tablist">
        <li class="nav-item d-flex align-items-center" role="presentation">
            <a class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all"
               type="button" role="tab" aria-controls="all" aria-selected="true" href="#">Categories</a>
        </li>
        <li class="nav-item d-flex align-items-center" role="presentation">
            <a class="nav-link" id="blog-tab" data-bs-toggle="pill" data-bs-target="#blog" type="button"
               role="tab" aria-controls="blog" aria-selected="true" href="#">Brands</a>
        </li>
    </ul>
    <div class="tab-content mt-3" id="pills-tabContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab" tabindex="0">
            <div class="pos_slider swiper">
                <div class="swiper-wrapper posCategoriesTab">
                    {{-- Dynamic POS Categories Loading Here --}}
                </div>
                <div class="slider_navs">
                    <div class="swiper-button-prev slide_nav_style"></div>
                    <div class="swiper-button-next slide_nav_style"></div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="blog" role="tabpanel" aria-labelledby="blog-tab" tabindex="0">
            <div class="pos_slider swiper">
                <div class="swiper-wrapper posBrandsTab">
                    {{-- Dynamic POS Brands Loading Here --}}
                </div>
                <div class="slider_navs">
                    <div class="swiper-button-prev slide_nav_style"></div>
                    <div class="swiper-button-next slide_nav_style"></div>
                </div>
            </div>
        </div>
    </div>
</div>
