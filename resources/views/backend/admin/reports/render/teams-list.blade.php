@forelse($users ?? [] as $key => $row)
    <tr>
        <td class="text-center">{{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
        <td class=" ">{{ appStatic()::USER_TYPES[$row->user_type] }}</td>
        <td>{{ $row->branch?->name ?? '-' }}</td>
        <td>
            <strong class="badge bg-accent badge-shadow">
                {{ $row->roles[0]->name ?? "N?A"}}
            </strong>
        </td>
        <td>{{ $row->getFullNameAttribute() }}</td>
        <td>{{ $row->email }}</td>
        <td>{{ $row->mobile_no }}</td>
        <td>{{ manageDateTime($row->created_at,2)  }}</td>
        <td class="text-center">
              <span class="badge rounded-pill {{ $row->account_status == 1 ? 'bg-success' : 'bg-danger' }}">
                {{ $row->account_status == 1 ? localize('Active') : localize('Disabled')  }}
            </span> 
        </td> 
    </tr>
@empty
    <x-common.empty-row colspan=9 />
@endforelse

{{ paginationFooter($users, 9) }}

