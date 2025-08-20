@forelse($brands as $key=> $brand)
    <div class="swiper-slide" >
        <div class="p_slide_item">
            <div class="text-center tt-single-category-brand">
                
          
            <x-form.input
                    type="checkbox"
                    :showDiv="false"
                    :value="$brand->id"
                    class="fireFilterRequest tt-custom-checkbox d-none"
                    id="brand{{ $brand->id }}"
                    name="brand_id[]"
                />
            <label for="brand{{ $brand->id }}"
                   class="tt-category-brand-info tt-b-first card border-0 p-3 cursor-pointer">
                <div class="tt-icon-box rounded-circle mb-3 tt-pos-slider">
                    <img src="{{ urlVersion($brand->media_file) }}"
                         alt="{{ $brand->localize_title ?? $brand->title }}"
                         class="img-fluid"
                    />
                    
                </div>
                <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1">{{ $brand->localize_title ?? $brand->title }}</h3>
                    <span class="fs-xs tt-available-item"> {{ $brand->total_products }} {{ localize("Items") }} </span>
            </label>
            </div>
        </div>
    </div>
@empty
@endforelse
