@props([
    'colspan' => 8,
    'loading' => '',
    'tdClass' => '',
])
<tr>
    <td colspan="{{ $colspan }}" class="null-td {{ $tdClass }}">
        <span class="bt-content">
            <div class="text-center section-space-y">
                @if ($loading)
                    Loading...
                @else
                    <span class="material-symbols-rounded fs-48 margin-bottom-5 lh-1">info</span>
                    <h5>No Data Found</h5>
                    <p>There is no data available.</p>
                @endif
            </div>
        </span>
    </td>
</tr>
