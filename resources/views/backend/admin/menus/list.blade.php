@forelse($menus ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($menus->currentPage() - 1) * $menus->perPage() }}</td>
        <td>{{ $row->name }}</td>
        <td>
            @foreach ($row->branches as $branch)
                <span class="badge bg-{{ ['primary','success','info','warning','danger'][rand(0,4)] }}">{{ $branch->name }}</span>
            @endforeach
        </td>
        <td>{{ manageDateTime($row->created_at,2)  }}</td>
        <td class="text-center"> 
             @include("common.active-status-button",["active" => $row->is_active,"route" => route('admin.menus.statusUpdate', $row->id)])
        </td>
        <td class="text-center">

            @if(isRouteExists("admin.menus.edit"))
                <a href="#" data-id={{ $row->id }} class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.menus.destroy"))
                    @if(isRouteExists("admin.menus.destroy"))
                        <x-delete-btn route="{{ route('admin.menus.destroy',$row->id) }}"
                                      id="{{ $row->id }}"></x-delete-btn>
                    @endif
            @endif
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($menus, 9) }}

