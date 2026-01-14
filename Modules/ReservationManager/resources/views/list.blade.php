@forelse($reservations ?? [] as $key => $reservation)
<tr class="{{ $reservation->trashed() ? 'table-danger' : '' }}">
    <td class="text-center">{{ $key + 1 + ($reservations->currentPage() - 1) * $reservations->perPage() }}</td>
    <td>{{ $reservation->branch->name ?? '-'  }}</td>
    <td>{{ $reservation->reservationTable->table->area->name ?? '-'  }}</td>
    <td>
        <span class="px-4 py-1 badge bg-warning rounded-pill">
            {{ $reservation->reservationTable->table->table_code ?? '-'  }}
        </span>
    </td>
    <td>{{ $reservation->customer->full_name ?? '-'  }}</td>
    <td>{{ $reservation->customer->email ?? '-'  }}</td>
    <td>{{ (new DateTime($reservation->end_datetime))->diff(new DateTime($reservation->start_datetime))->format('%h hours %i minutes') }}</td>
    <td>{{ $reservation->start_datetime ?? '-'  }}</td>
    <td>{{ $reservation->end_datetime ?? '-'  }}</td>
    <td>
        <span class="badge bg-warning rounded-pill">
            {{ $reservation->number_of_guests ?? '-' }}
        </span>
    </td>
    <td>{{ $reservation->total_reservation_amount ?? '-'  }}</td>
    <td>{{ $reservation->advance_reservation_payment ?? '-'  }}</td>
    <td>{{ $reservation->due_reservation_payment > 0 ? $reservation->due_reservation_payment : $reservation->total_reservation_amount - $reservation->advance_reservation_payment }}</td>
    <td>{{ manageDateTime($reservation->created_at,2)  }}</td>
    <td class="text-center">            
        <span class="badge rounded-pill {{ $reservation->status->title == 'Completed' ? 'bg-success' : ($reservation->status->title == 'Confirmed' ? 'bg-success' : 'bg-danger') }}">
            {{ $reservation->status->title ?? '-'  }}
        </span>
    </td>        
    <td class="text-center">            
        @if (isVendorUserGroup())
            @if(!$reservation->trashed())
                <a href="{{ route('reservationmanager.edit', $reservation->id) }}" class="editIcon">
                    <i data-feather="edit" class="icon-14"></i>
                </a>
                <a href="#"
                    data-id="{{ $reservation->id }}"
                    data-url="{{ route('reservationmanager.destroy', $reservation->id) }}"
                    data-method="DELETE"
                    class="deleteReservations text-danger ms-1">
                    <i data-feather="trash-2" class="icon-14"></i>
                </a>
            @else
                <a href="#"
                    data-id="{{ $reservation->id }}"
                    data-url="{{ route('reservationmanager.restore', $reservation->id) }}"
                    class="restoreReservation text-success me-1">
                    <i data-feather="rotate-ccw" class="icon-14"></i>
                </a>
                <a href="#"
                    data-id="{{ $reservation->id }}"
                    data-url="{{ route('reservationmanager.forceDelete', $reservation->id) }}"
                    class="forceDeleteReservation text-danger ms-1">
                    <i data-feather="trash" class="icon-14"></i>
                </a>
            @endif
        @else
            -
        @endif
    </td>
</tr>
@empty
    <x-common.empty-row colspan=19 />
@endforelse

{{ paginationFooter($reservations, 9) }}
