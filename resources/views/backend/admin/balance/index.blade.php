@php
    if($type == appStatic()::PURPOSE_IMAGE){
        $totalBalance     = userActivePlan()["image_balance"] ?? 0;
        $totalUsed        = userActivePlan()["image_balance_used"] ?? 0;
        $totalRemainingBalance = userActivePlan()["image_balance_remaining"] ?? 0;
    }
    else if($type == appStatic()::PURPOSE_TEXT_TO_VOICE){
        $totalBalance      = userActivePlan()["word_balance_t2s"] ?? 0;
        $totalUsed         = userActivePlan()["word_balance_used_t2s"] ?? 0;
        $totalRemainingBalance = userActivePlan()["word_balance_remaining_t2s"] ?? 0;
    }
    else if($type == appStatic()::PURPOSE_VOICE_TO_TEXT){
        $totalBalance      = userActivePlan()["speech_balance"] ?? 0;
        $totalUsed         = userActivePlan()["speech_balance_used"] ?? 0;
        $totalRemainingBalance = userActivePlan()["speech_balance_remaining"] ?? 0;
    }
    else if($type == appStatic()::PURPOSE_VIDEO){
        $totalBalance      = userActivePlan()["video_balance"] ?? 0;
        $totalUsed         = userActivePlan()["video_balance_used"] ?? 0;
        $totalRemainingBalance = userActivePlan()["video_balance_remaining"] ?? 0;
    }else{
        $totalBalance      = userActivePlan()["word_balance"] ?? 0;
        $totalUsed         = userActivePlan()["word_balance_used"] ?? 0;
        $totalRemainingBalance = userActivePlan()["word_balance_remaining"] ?? 0;
    }
 @endphp

@php
    $percentageUsed = ($totalUsed == 0) ? 100 : ($totalUsed / $totalBalance) * 100;
@endphp


    <div class="d-flex align-items-center flex-column bg-light-subtle px-3 py-2 rounded">
        <div class="d-flex justify-content-between w-100 fs-md lh-1 mb-2">
            <span>
                {{ localize("Total") }}: <strong class="balanceTotal">{{ $totalBalance }} </strong>
            </span>

            <span class="ms-4">
                {{ localize("Remaining Balance") }}: <strong class="balanceRemaining">{{ $totalRemainingBalance }}</strong>
            </span>
        </div>

        <div class="progress w-100 mb-1" style="height: 4px;">
            <div class="progress-bar bg-warning balanceProgressBar"
                 role="progressbar"
                 style="width: {{ 100 - $percentageUsed }}%"
                 aria-valuenow="{{ $totalUsed }}"
                 aria-valuemin="0"
                 aria-valuemax="100">
            </div>
        </div>
    </div>