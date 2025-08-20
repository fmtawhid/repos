@if ($dataModel->hasPages())
    <tr>
        <td colspan="{{ $colspan }}" style="text-align: center">
            {!! $dataModel->withQueryString($_GET)->links('common.page-info') !!}
        </td>
    </tr>
@endif
