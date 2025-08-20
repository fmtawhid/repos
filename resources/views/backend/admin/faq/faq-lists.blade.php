

@forelse($faqs as $faq)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $faq->question }}</td>
        <td>{{ $faq->answer }}</td>
        <td class="text-center">
            @include("common.active-status-button",["active" => $faq->is_active,"route" => route('admin.faqs.statusUpdate', $faq->id)])
        </td>
        <td class="text-center">
            @if(isRouteExists("admin.faqs.edit"))
                <a href="#"
                   data-update-url="{{ route('admin.faqs.update', $faq->id) }}"
                   data-url="{{ route('admin.faqs.edit',$faq->id) }}"
                   data-id="{{ $faq->id }}"
                   class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            @if(isRouteExists("admin.faqs.destroy"))
                <a href="#" data-id="{{ $faq->id }}"
                               data-href="{{ route('admin.faqs.destroy', $faq->id) }}"
                               data-method="DELETE"
                               class="erase btn-sm p-0 bg-transparent border-0"
                               type="button">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}" class="text-danger ms-1"><i data-feather="trash-2" class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
     <x-common.empty-row colspan=5 />
@endforelse
{{ paginationFooter($faqs, 5) }}
