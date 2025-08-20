<div class="row g-2 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6">
    @foreach ($tables as $index => $table)                    
        <div class="col m-2 border bg-opacity-25 p-3">
            <a href="{{ route('pos.dashboard', ['qrcode' => $table->qrCode->code ?? '']) }}">
                <div class="showQrCodeImage" data-table="{{ $table }}" data-code="{{ $table->qrCode->code ?? '' }}">
                    <div class="my-1 d-flex justify-content-between">
                        <div class="pull-left">{{ $table->table_code ?? '' }}</div>
                        <div class="pull-right">{{ $table->number_of_seats ?? '' }} Seat(s)</div>
                    </div>
                </div>
            </a>
            {{-- <div class="download_qr_code">             --}}
                {{-- download     --}}
                {{-- <button class="btn btn-sm btn-primary downloadQrCodeBtn" data-qu_code_id="{{ $table->qrCode->id }}">
                    {{ localize('Download QR Code') }}
                </button> --}}
            {{-- </div> --}}
        </div>
    @endforeach
</div>
