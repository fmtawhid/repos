@php
    $mainLoop = $childLoop = 0;
    $permissionId = null;
@endphp

@forelse($customGroupAndPermissions as $key => $customGroupAndPermission)
    @php
        $mainLoop++;
        $groupId = "group_" . $mainLoop;
        $permissionId = null;
    @endphp

    @if(!hideForVendor($customGroupAndPermission))
        <div class="mb-4">
            {{-- Group Header --}}
            <div class="mb-2 d-flex align-items-center flex-wrap gap-2 border-bottom pb-2">
                <div class="form-check form-switch">
                    <input type="checkbox"
                           class="form-check-input groupCheckbox"
                           id="{{ $groupId }}"
                           value="{{ $key }}"
                    />
                    <label for="{{ $groupId }}"
                           class="groupTitle cursor-pointer ms-1">
                         <strong>{{ ucwords("Select all ".textReplace($key,"_"," "))  }}</strong>
                    </label>
                </div>
            </div>

            {{-- Group Children --}}
            <div class="groupUl row">
                @forelse($customGroupAndPermission as $key1 => $value)
                    @php
                        if(isCacheExists("perm{$value}")){
                            $cachePermission = getCache("perm{$value}");
                            $permissionId = $cachePermission ? $cachePermission->id : null;
                        } else {
                            $permission = \App\Models\Permission::query()
                                ->where('route', $value)
                                ->first();
                            if($permission) {
                                setCacheData("perm{$value}", $permission);
                                $permissionId = getCache("perm{$value}")->id;
                            }
                        }

                        $childLoop++;
                        $stringId = "perm_$childLoop";
                    @endphp

                    @if($key1 !== "hideForVendor" && $permissionId)
                        <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-check form-switch">
                                <input type="checkbox"
                                       class="form-check-input roleCheckbox childCheckbox"
                                       id="perm{{ $permissionId }}"
                                       data-group-id="{{ $groupId }}"
                                       value="{{ $permissionId }}"
                                       name="permission_id[]"
                                       @isset($rolePermissionRouteNames)
                                           {{ in_array($value, $rolePermissionRouteNames) ? "checked" : "" }}
                                       @endisset
                                />
                                <label for="perm{{ $permissionId }}"
                                       class="form-check-label cursor-pointer d-block w-100">
                                    {{ ucwords(textReplace($key1,"_"," "))  }}
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
@empty
@endforelse

{{-- JS Section --}}
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {

    // Parent group checkbox click → toggle children
    document.querySelectorAll(".groupCheckbox").forEach(function(parent) {
        parent.addEventListener("change", function() {
            let groupId = this.id;
            let children = document.querySelectorAll(`input.childCheckbox[data-group-id='${groupId}']`);
            children.forEach(function(child) {
                child.checked = parent.checked;
            });
        });
    });

    // Child checkbox click → update parent
    document.querySelectorAll(".childCheckbox").forEach(function(child) {
        child.addEventListener("change", function() {
            let groupId = this.dataset.groupId;
            let parentCheckbox = document.getElementById(groupId);
            let allChildren = document.querySelectorAll(`input.childCheckbox[data-group-id='${groupId}']`);
            let allChecked = Array.from(allChildren).every(c => c.checked);
            parentCheckbox.checked = allChecked;
        });
    });

});
</script>
@endpush
