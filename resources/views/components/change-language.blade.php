<select id="language" class="w-100 min-w-150 form-control text-capitalize country-flag-select" data-toggle="select2"
    onchange="localizeData(this.value)">
    @foreach ($languages as $key => $language)
        <option value="{{ $language->code }}" {{ $lang_key == $language->code ? 'selected' : '' }}
            data-flag="{{ urlVersion('backend/assets/img/flags/' . $language->flag . '.png') }}">
            {{ $language->name }}
        </option>
    @endforeach
</select>