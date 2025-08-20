@forelse($categories as $key=> $category)
    <div class="swiper-slide">
        <div class="p_slide_item">
            <div class="text-center tt-single-category-brand">
                <x-form.input
                    type="checkbox"
                    :showDiv="false"
                    :value="$category->id"
                    class="fireFilterRequest tt-custom-checkbox d-none"
                    id="category{{ $category->id }}"
                    name="category_id[]"
                />
           

            <label for="category{{ $category->id }}" class="tt-category-brand-info tt-b-first card border-0 p-3 cursor-pointer tt-pos-slider">
                <div class="tt-icon-box rounded-circle mb-3 tt-pos-slider">
                    <img src="{{ urlVersion($category->media_file) }}"
                         alt="{{ $category->localize_title ?? $category->title }}"
                         class="img-fluid"
                    />
                </div>
                <h3 class="fs-sm mb-1 tt-line-clamp tt-clamp-1">{{ $category->title }}</h3>
                <span class="fs-xs tt-available-item"> {{ $category->total_products }} {{ localize("Items") }} </sp>
            </label>
            </div>
        </div>
    </div>
@empty
@endforelse
