
<form action="{{ route('admin.menu-items.store') }}" method="POST" id="addMenuItemFrm">
<div class="offcanvas offcanvas-end" id="addMenuItemSideBar" tabindex="-1">
        @csrf
        @method("POST")
        <x-form.input name="id" id="id" type="hidden" value="" showDiv=0 />
        <div class="offcanvas-header border-bottom py-3">
            <h5 class="offcanvas-title">{{ localize('Add Menu Item') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <x-common.message class="mb-3" />

            <div class="mb-3">
                <x-form.label for="name" label="{{ localize('Name') }}" isRequired=true />
                <x-form.input name="name" id="name" type="text" placeholder="{{ localize('Name') }}" value="" showDiv=false />
            </div>

            <div class="mb-3">
                <label for="textarea-input" class="form-label">{{ localize('Description') }}</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="{{ localize('description') }}" value=""></textarea>
            </div>

            <div class="mb-3">
                <div class="mb-4">
                    <x-form.label for="media_manager_id" label="{{ localize('Item Image') }}"  />
                    <div class="tt-image-drop rounded">
                        <span class="fw-semibold">{{ localize('Choose Item Image') }}</span>
                        <!-- choose media -->
                        <div class="tt-product-thumb show-selected-files mt-3">
                            <div class="avatar avatar-xl cursor-pointer choose-media"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                onclick="showMediaManager(this)" data-selection="single">
                                <input type="hidden" name="media_manager_id" id="media_manager_id">
                                <div class="no-avatar rounded-circle">
                                    <span><i data-feather="plus"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- choose media -->
                    </div>
                </div>
            </div>                        
           
            <div class="mb-3">
                <x-form.label for="is_active" label="{{ localize('Status') }}" />
                <x-form.select name="is_active" id="is_active">
                    <option value="">-- {{ localize('Select Status') }} --</option>
                    @foreach (appStatic()::STATUS_ARR as $menuItemStatusId => $menuItemStatus)
                        <option value="{{ $menuItemStatusId }}">{{ $menuItemStatus }}</option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <x-form.label for="menu_id" label="{{ localize('Menu') }}" />
                    <x-form.select class="select2" name="menu_id" id="menu_id">
                        <option value="">-- {{ localize('Select Menu') }} --</option>                        
                        @foreach ($menus as $menuId => $menu)
                            <option value="{{ $menu->id }}">{{ $menu->name ?? '' }}</option>
                        @endforeach
                    </x-form.select>
                </div> 
                
                <div class="col-md-6">
                    <x-form.label for="item_category_id" label="{{ localize('Item Category') }}" />
                    <x-form.select name="item_category_id" class="select2" id="item_category_id">
                        <option value="">-- {{ localize('Select Item Category') }} --</option> 
                        @foreach ($itemCategories as $categoryId => $category)
                            <option value="{{ $category->id }}">{{ $category->name ?? '' }}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">{{ localize("Preparation Time") }}</label>
                <div class="input-group input-group-sm">
                    <input class="form-control" id="preparation_time" name="preparation_time" type="number" value="" min="1" step="1">
                    <span class="input-group-text">{{ localize('minutes') }}</span>
                </div>
            </div> 

            <div class="mb-1">
                <label for="variation" class="form-label">{{ localize("Variations") }}</label>
                <div id="variationItems">
                    <div class="variant-item mb-2 d-flex align-items-center gap-2">
                        <input type="text" class="form-control form-control-sm" name="variation_titles[]" placeholder="Variant title">
                        <input type="text" class="form-control form-control-sm" name="variation_prices[]" placeholder="Variant price">
                        <button type="button" class="deleteVariation btn btn-soft-danger btn-sm flex-shrink-0">
                            <i data-feather="trash" class="icon-14"></i>
                        </button>
                    </div>
                    
                    {{-- variation will load here through ajax  --}}
                </div>            
            </div>            

            <div class="mb-2 addVariationButton">
                <button type="button" class="addNewVariation btn btn-link px-0 fw-medium fs-base pt-0">
                    <i data-feather="plus" class="icon-14"></i>{{ localize('Add more') }}
                </button>
            </div>

            
            <div class="mb-1">
                <label for="addons" class="form-label">{{ localize("Addons") }}</label>
                <div id="addonItems"> 
                    {{-- addons will load here through ajax  --}}
                </div>            
            </div>            

            <div class="mb-3 addAddonButton">
                <button type="button" class="addNewAddon btn btn-link px-0 fw-medium fs-base pt-0">
                    <i data-feather="plus" class="icon-14"></i>{{ localize('Add Addon') }}
                </button>
            </div>
        </div>


        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <x-form.button id="addMenuItemBtn">{{ localize('Save') }}</x-form.button>
                <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
            </div>
        </div>
    </div>
</form>
