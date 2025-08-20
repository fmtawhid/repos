                                  
@forelse($reservations ?? [] as $key => $reservation)
    <tr>
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
        <td>{{ (new DateTime($reservation->end_datetime))->diff(new DateTime($reservation->start_datetime))->format('%h hours %i minutes')  }}</td>
        <td>{{ $reservation->start_datetime ?? '-'  }}</td>
        <td>{{ $reservation->end_datetime ?? '-'  }}</td>
        <td>
            <span class="badge bg-warning rounded-pill">
                {{ $reservation->number_of_guests ?? '-' }}
            </span>       
        </td>
        <td>{{ $reservation->total_reservation_amount ?? '-'  }}</td>
        <td>{{ $reservation->advance_reservation_payment ?? '-'  }}</td>
        <td>{{ $reservation->due_reservation_payment > 0 ? $reservation->due_reservation_payment : $reservation->total_reservation_amount - $reservation->advance_reservation_payment  }}</td>
        <td>{{ manageDateTime($reservation->created_at,2)  }}</td>
        <td class="text-center">            
            <span class="badge rounded-pill {{ $reservation->status->title == 'Completed' ? 'bg-success' : ($reservation->status->title == 'Confirmed' ? 'bg-success' : 'bg-danger') }}">
                {{ $reservation->status->title ?? '-'  }}
            </span>
        </td>        
        <td class="text-center">            
            @if (isVendorUserGroup())
                <a href="{{ route('reservationmanager.edit', $reservation->id) }}" data-id={{ $reservation->id }} class="editIcon">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Edit') }}"><i data-feather="edit" class="icon-14"></i></span>
            </a>
            <a href="#"
                data-id="{{ $reservation->id }}"
                data-url="{{ route('reservationmanager.destroy', $reservation->id) }}"
                data-method="DELETE"
                class="deleteReservations text-danger ms-1">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ localize('Delete') }}"><i data-feather="trash-2" class="icon-14"></i></span>
            </a>
            @else
                -
            @endif
        </td>
    </tr>
@empty
    <x-common.empty-row colspan=19 />
@endforelse

{{ paginationFooter($reservations, 9) }}

