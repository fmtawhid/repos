@foreach ($localizations as $key => $localization)
<tr>
    <td class="text-center align-middle">
        {{ $key + 1 + ($localizations->currentPage() - 1) * $localizations->perPage() }}
    </td>

    <td class="align-middle">
        <a class="d-flex align-items-center">
            <h6 class="fs-sm mb-0 key">{{ $localization->t_value }}</h6>
        </a>
    </td>
    <td class="align-middle">
        <input type="text" class="form-control value w-100"
            name="values[{{ $localization->t_key }}]"
            placeholder="{{ localize('Type localization here') }}"
            @if (($localization_lang = \App\Models\Localization::where('lang_key', $language->code)->where('t_key', $localization->t_key)->latest()->first()) != null) value="{{ $localization_lang->t_value }}" @endif>
    </td>

</tr>

@endforeach
{{ paginationFooter($localizations, 3) }}

