@php
    $mainLoop = $childLoop = 0;
@endphp

@forelse($customGroupAndPermissions as $key=>$customGroupAndPermission)
    @if (allowPlanFeature($key) || in_array($key, ['reports']))
        @php
            $mainLoop++;
            $groupId = 'group_' . $mainLoop;
        @endphp

        @if (!hideForVendor($customGroupAndPermission))
            <div class="mb-4">
                <div class="mb-2 d-flex align-items-center flex-wrap gap-2 border-bottom pb-2">
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input roleCheckbox" id="{{ $groupId }}"
                            value="{{ $key }}" />

                        <label for="{{ $groupId }}" data-checked="false" class="groupTitle cursor-pointer ms-1">
                            <strong>{{ ucwords(textReplace($key, '_', ' ')) }}</strong>
                        </label>
                    </div>
                </div>

                <div class="groupUl row">
                    @forelse($customGroupAndPermission ?? [] as $key1=>$value)
                        @php
                           if (isCacheExists("perm{$value}")) {
                                $cachePermission = getCache("perm{$value}");
                                $permissionId    = $cachePermission?->id ?? null;
                           }
                           else {
                                $permission = \App\Models\Permission::query()->where('route', $value)->first();
                                setCacheData("perm{$value}", $permission);
                                $permissionId = getCache("perm{$value}")->id;
                           }

                            $childLoop++;
                            $stringId = "perm_$childLoop";
                        @endphp
                        @if ($key1 !== 'hideForVendor')
                            <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input roleCheckbox me-1"
                                        id="perm{{ $permissionId }}" data-group-id="{{ $groupId }}"
                                        value="{{ $permissionId }}" name="permission_id[]"
                                        @isset($rolePermissionRouteNames)
                                    {{ in_array($value, $rolePermissionRouteNames) ? 'checked' : '' }}
                                @endisset />

                                    <label for="perm{{ $permissionId }}"
                                        class="form-check-label cursor-pointer d-block w-100">
                                        {{ ucwords(textReplace($key1, '_', ' ')) }}
                                    </label>
                                </div>

                                <?= errorBlock('route') ?>
                            </div>
                        @endif
                    @empty
                    @endforelse
                </div>

            </div>
        @endif
    @endif
@empty
@endforelse
