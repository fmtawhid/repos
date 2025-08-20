<div class="card-header">
    <h5 class="mb-0">{{ localize('All Tickets') }}</h5>
</div>
<div class="card-body p-0">
    <div class="list-group list-group-flush">
        @foreach ($tickets as $ticket)
            <a href="{{route('admin.support-tickets.reply', $ticket->id)}}" target="_blank" class="list-group-item list-group-item-action py-3">
                <div class="d-flex">
                    <div class="avatar avatar-md me-2 flex-shrink-0">
                        <img class="rounded-circle"
                            src="{{ avatarImage($ticket->createdBy->avatar_id) }}" alt="avatar"
                            onerror="this.onerror=null;this.src='{{ avatarImage($ticket->createdBy->avatar_id) }}';">
                    </div>
                    <div class="flex-1">
                        <h6 class="mb-1">{{ $ticket->title }} #{{ $ticket->id }}
                            <span
                                class="fs-ms fw-medium rounded-pill badge shadow-sm text-black">{{ $ticket->priority->name }}</span>
                        </h6>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <span class="text-muted"><i data-feather="folder"
                                        class="icon-14 me-1"></i>{{ localize('Category') }}:{{ $ticket->category->name }}
                                </span>
                            </li>
                            @if($ticket->category->staff)
                                <li class="list-inline-item">
                                    <span class="text-muted"><i data-feather="user"
                                            class="icon-14 me-1"></i>{{ localize('Assigned') }}:
                                        {{ $ticket->category->staff->name }}</span>
                                </li>
                            @endif
                            <li class="list-inline-item">
                                <span class="text-muted"><i data-feather="calendar"
                                        class="icon-14 me-1"></i>{{ localize('Date') }}:
                                    {{ date('d-M-y h:i:s A', strtotime($ticket->created_at)) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </a>
        @endforeach


    </div>
</div>
<div class="card-footer">
    <div class="d-flex align-items-center justify-content-between">
        <span>{{ $tickets->firstItem() ?? 0 }}-{{ $tickets->lastItem() ?? 0 }}
            {{ localize('of') }}
            {{ $tickets->total() }} {{ localize('results') }}</span>
        <nav>
            {{ $tickets->appends(request()->input())->onEachSide(0)->links() }}
        </nav>
    </div>
</div>