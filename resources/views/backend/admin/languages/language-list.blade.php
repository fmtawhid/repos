@forelse($languages as $language)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            <a class="d-flex align-items-center">
                <div class="avatar avatar-sm">
                    <img class="rounded-circle" src="{{ urlVersion('assets/img/flags/' . $language->flag . '.png') }}"
                        alt="{{ $language->flag }}" />
                </div>
                <h6 class="fs-sm mb-0 ms-2">{{ $language->name }}
                </h6>
            </a>
        </td>
        <td> {{ $language->code }}</td>

        <td class="text-center">
            @include('common.active-status-button', [
                'active' => $language->is_active,
                'id' => encrypt($language->id),
                'model' => 'langauge',
                'name'   => 'is_active',
            ])
        </td>
        <td class="text-center">
            @include('common.active-status-button', [
                'active' => $language->is_active_for_templates,
                'id' => encrypt($language->id),
                'model' => 'langauge',
                'name'   => 'is_active',
            ])
        </td>
        <td class="text-center">
            @if (isRouteExists('admin.languages.edit'))
                <a href="#" data-update-url="{{ route('admin.languages.update', $language->id) }}"
                    data-url="{{ route('admin.languages.edit', $language->id) }}" data-id="{{ $language->id }}"
                    class="editIcon">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
                </a>
            @endif

            
            @if (isRouteExists('admin.localizations.show'))
                <a href="{{ route('admin.localizations.show', $language->id) }}" 
                    class="btn-sm p-0 bg-transparent border-0" type="button">
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Localizations') }}" class=" ms-1"><i data-feather="globe"
                            class="icon-14"></i></span>
                </a>
            @endif
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=6 />
@endforelse
{{ paginationFooter($languages, 6) }}
