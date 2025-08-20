@if ($dataModel->hasPages())
    <div style="text-align: center">
        {!! $dataModel->withQueryString($_GET)->links('common.page-info') !!}
    </div>
@endif
