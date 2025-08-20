@forelse($permissions as $permission)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $permission->display_title }}</td>
        <td>{{ $permission->url }}</td>
        <td>{{ $permission->route }}</td>
        <td>{{ $permission->method_type }}</td>
        <td>
            <div class="form-check form-switch">
                <input type="checkbox"
                       name="is_allowed_in_demo"
                       id="is_allowed_in_demo"
                       class="form-check-input changeAllowInDemoStatus"
                       data-id="{{ $permission->id }}"
                        @checked($permission->is_allowed_in_demo)
                />
            </div>
        </td>
        <td>
            @include("common.active-status-button",[
                "name"   => "is_active",
                "id"     => encrypt($permission->id),
                "model"  => "permission",
                "active" => $permission->is_active
            ])
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=7 />
@endforelse

{{ paginationFooter($permissions, 7) }}