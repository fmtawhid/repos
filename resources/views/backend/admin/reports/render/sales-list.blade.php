{{-- @forelse ($usage as $key => $use)
    <tr>
        <td class="text-center">
            {{ $key + 1 + ($usage->currentPage() - 1) * $usage->perPage() }}
        </td>
        <td>
            <span class="fs-sm">{{ date('d M, Y', strtotime($use->created_at)) }}</span>
        </td>
        <td> {{ $use->content_type }} </td>
        <td> {{ $use->createdBy->name }} </td>
        <td class="text-end">
            <span class="fw-bold">{{ formatWords($use->total_words) }}</span>
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=5 />
@endforelse
{{ paginationFooter($usage, 5) }} --}}