@forelse($currencies as $currency)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td class="fw-semibold">{{ $currency->name }} </td>
        <td>  {{ $currency->symbol }} </td>
        <td class="fw-semibold">{{ $currency->code }} </td>
        <td>  {{ $currency->alignment == 0 ? localize('[symbol][amount]') : localize('[amount][symbol]') }}</td>
        <td class="fw-semibold">  {{ $currency->rate }} </td>
        <td class="text-center"> 
            @include("common.active-status-button",["active" => $currency->is_active,"route" => route('admin.currencies.statusUpdate', $currency->id)])
        </td>
        <td class="text-center">
            @if (isRouteExists('admin.currencies.edit'))
                <a href="#" data-update-url="{{ route('admin.currencies.update', $currency->id) }}"
                    data-url="{{ route('admin.currencies.edit', $currency->id) }}" data-id="{{ $currency->id }}"
                    class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif
            @if($currency->code !== appStatic()::DEFAULT_CURRENCY_CODE)
                @if (isRouteExists('admin.currencies.destroy'))
                    <a href="#" data-id="{{ $currency->id }}"
                        data-href="{{ route('admin.currencies.destroy', $currency->id) }}" data-method="DELETE"
                        class="erase btn-sm p-0 bg-transparent border-0" type="button">
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}" class="text-danger ms-1"><i data-feather="trash-2"
                                class="icon-14"></i></span>
                    </a>
                @endif
            @endif

        </td>
    </tr>
@empty
    <x-common.empty-row colspan=8 />
@endforelse
{{ paginationFooter($currencies, 8) }}
