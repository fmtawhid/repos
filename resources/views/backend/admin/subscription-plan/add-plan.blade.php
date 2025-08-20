    <div class="offcanvas offcanvas-end" id="addPlanFormSidebar" tabindex="-1">

        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">{{ localize('Create New Subscription Plan') }}</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <x-common.splitter />
        <div class="offcanvas-body">
            <div class="newPlan" id="newPlan">
                <div class="d-flex justify-content-center pb-3 mt-3">
                    <form class="copy-package-form" id="addPlanForm" action="{{route('admin.subscription-plans.store')}}" method="POST">
                        @method('POST')
                        @csrf    
                        <div class="form-group">
                            <x-form.label label="{{ localize('Package Type') }}" for="packageType"></x-form.label>

                            <x-form.select name="package_type" required class="form-select form-select-transparent form-select--sm" id="packageType">
                                @forelse(appStatic()::PACKAGE_TYPE_ARR as $key=>$value)
                                    <option value="{{ $key }}">{{ ucfirst($value) }} </option>
                                @empty
                                @endforelse
                            </x-form.select>
                        </div>

                        <button type="submit"
                                class="btn btn-secondary px-4 ms-2 pkg-submit-btn"
                                id="frmActionBtn">{{ localize('Create New Plan') }}</button>
                    </form>
                </div>
                <div class="text-center text-muted mb-3">{{ localize('Or') }}</div>

                <form class="copy-package-form" id="addPlanCopyForm" action="{{route('admin.subscription-plans.store')}}" method="POST">
                    @csrf
                    <div class="form-input d-flex justify-content-center">
                        <select class="form-select select2 w-50" id="package_id" name="package_id" required>
                            <option value="">{{ localize('Copy From Existing') }}
                            </option>
    
                            <optgroup label="{{ localize('Monthly Plans') }}">
                                @foreach ($packages as $package)
                                    @if ($package->package_type == 'monthly' || $package->package_type == 'starter')
                                        <option value="{{ $package->id }}">
                                            {!! html_entity_decode($package->title) !!}</option>
                                    @endif
                                @endforeach
                            </optgroup>
    
                            <optgroup label="{{ localize('Yearly Plans') }}">
                                @foreach ($packages as $package)
                                    @if ($package->package_type == 'yearly')
                                        <option value="{{ $package->id }}">
                                            {!! html_entity_decode($package->title) !!}</option>
                                    @endif
                                @endforeach
                            </optgroup> 
                        </select>
                        <div class="d-flex justify-content-center ms-2">
                            <button type="submit" class="btn btn-primary pkg-submit-btn" id="frmActionCopyBtn">{{ localize('Copy') }}</button>
                        </div>
                    </div>
                </form>

            </div>
            <div id="editPlan"></div>
        </div>
    </div>
