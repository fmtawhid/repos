@props([
    "total",
    "used",
    "remaining",

])

@php
    $percentageUsed = ($used == 0) ? 100 : ($used / $total) * 100;
@endphp


    <div class="d-flex align-items-center flex-column bg-light-subtle px-3 py-2 rounded">
        <div class="d-flex justify-content-between w-100 fs-md lh-1 mb-2">
            <span>
                {{ localize("Total") }}: <strong class="balanceTotal">{{ $total }} </strong>
            </span>

            <span class="ms-4">
                {{ localize("Remaining Balance") }}: <strong class="balanceRemaining">{{ $remaining }}</strong>
            </span>
        </div>

        <div class="progress w-100 mb-1" style="height: 4px;">
            <div class="progress-bar bg-warning balanceProgressBar"
                 role="progressbar"
                 style="width: {{ 100 - $percentageUsed }}%"
                 aria-valuenow="{{ $used }}"
                 aria-valuemin="0"
                 aria-valuemax="100">
            </div>
        </div>
    </div>
