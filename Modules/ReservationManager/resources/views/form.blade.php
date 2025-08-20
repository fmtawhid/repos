 <div>
    <div class="card-body">
        <x-common.message class="mb-3" />

        <div class="row">
            <div class="col mb-3">
                <x-form.label for="customer_first_name" label="{{ localize('Customer First Name') }}" isRequired=true />
                <x-form.input name="customer_first_name" id="customer_first_name" type="text" placeholder="{{ localize('Customer First Name') }}" value="{{ $reservation->customer->first_name ?? old('customer_first_name') }}" showDiv=false />
            </div>

            <div class="col mb-3">
                <x-form.label for="customer_last_name" label="{{ localize('Customer Last Name') }}" isRequired=true />
                <x-form.input name="customer_last_name" id="customer_last_name" type="text" placeholder="{{ localize('Customer Last Name') }}" value="{{ $reservation->customer->last_name ?? old('customer_last_name') }}" showDiv=false />
            </div>


            <div class="col mb-3">
                <x-form.label for="customer_email" label="{{ localize('Customer Email') }}" isRequired=true />
                <x-form.input name="customer_email" id="customer_email" type="email" placeholder="{{ localize('Customer Email') }}" value="{{ $reservation->customer->email ?? old('customer_email') }}" showDiv=false />
            </div>          
        </div>    

        <div class="row">                                         
            
            <div class="col mb-3">
                <x-form.label for="customer_phone" label="{{ localize('Customer Phone') }}" isRequired=true />
                <x-form.input name="customer_phone" id="customer_phone" type="text" placeholder="{{ localize('Customer Phone') }}" value="{{ $reservation->customer->mobile_no ?? old('customer_phone') }}" showDiv=false />
            </div>
        </div>    
        
        <div class="row">
            <div class="col mb-3">
                <x-form.label for="branch_id" label="{{ localize('Branch') }}" />
                <x-form.select class="changeBranch" name="branch_id" id="branch_id" style="width: 100%">
                    <option value="{{ $reservation->branch_id ?? '' }}">
                        {{ localize('Select Branch') }}
                    </option>                        

                    @foreach ($branches ?? [] as $branchId => $branchName)
                        <option value="{{ $branchId }}">{{ $branchName ?? '' }}</option>
                    @endforeach
                </x-form.select>                                              
                {{-- <span class="text-danger">
                    <strong>
                        @if ($errors->has('branch_id'))
                            {{ $errors->first('branch_id') }}
                        @endif
                    </strong>
                </span> --}}

            </div>


            <div class="col mb-3">
                <div class="area_loader"></div>
                <x-form.label for="area_id" label="{{ localize('Area') }}" />
                <x-form.select class="changeArea getAreaList" name="area_id" id="area_id" style="width: 100%">
                    <option value="{{ $reservation->area_id ?? '' }}">{{ $reservation->reservationTable->table->area->name ?? old('area_id') }}</option>                        
                </x-form.select>
                {{-- <span class="text-danger">
                    <strong>
                        @if ($errors->has('area_id'))
                            {{ $errors->first('area_id') }}
                        @endif
                    </strong>
                </span> --}}
            </div>

            <div class="col mb-3">
                <x-form.label for="number_of_guests" label="{{ localize('Number of Guests') }}" isRequired=true />
                <x-form.input name="number_of_guests" id="number_of_guests" type="number" placeholder="{{ localize('Number of Guests') }}" value="{{ $reservation->number_of_guests ?? old('number_of_guests') }}" showDiv=false />
            </div>
        </div>                                       

        <div class="table_list_section mb-3">
            <div class="reservation_table_list mb-4 row g-3 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                {{-- load tables from ajax query --}}

                {{-- table list only for edit --}}                
                @if (isset($reservation))
                    @foreach ($reservation->area->tables ?? [] as $table)
                        <div class="col">
                            <div data-id="{{ $table->id }}" class="makeTableSelected border {{$reservation->reservationTable->table_id == $table->id ? 'border-success' : '' }} tt-table-item bg-light-subtle border rounded-3 p-2 cursor-pointer">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">Table Code: {{ $table->table_code ?? '' }}</h6>
                                    <span class="badge bg-success rounded-pill">{{ $table->is_active ? 'Available' : 'Unavailable' }}</span>
                                </div>
                                <div class="p3">
                                    <p class="mb-0">Total Seats: {{ $table->number_of_seats ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                {{-- end --}}       
            </div>
            <input type="hidden" name="table_id" id="table_id" value="{{$reservation->reservationTable->table->id ?? ''}}">
        </div>
        
            <div class="row">
            <div class="col mb-3">
                <x-form.label for="start_datetime" label="{{ localize('Start Date Time') }}" isRequired=true />
                <x-form.input name="start_datetime" id="start_datetime" type="datetime-local" placeholder="{{ localize('Start Date Time') }}" value="{{ $reservation->start_datetime ?? old('start_datetime') }}" showDiv=false />
            </div>

            <div class="col mb-3">
                <x-form.label for="end_datetime" label="{{ localize('End Date Time') }}" isRequired=true />
                <x-form.input name="end_datetime" id="end_datetime" type="datetime-local" placeholder="{{ localize('End Date Time') }}" value="{{ $reservation->end_datetime ?? old('end_datetime') }}" showDiv=false />
            </div>
        </div>

        <div class="row">
            <div class="col mb-3">
                <x-form.label for="total_reservation_amount" label="{{ localize('Total Reservation Amount') }}" isRequired=true />
                <x-form.input name="total_reservation_amount" id="total_reservation_amount" type="number" step="0.01" placeholder="{{ localize('Total Reservation Amount') }}" value="{{ $reservation->total_reservation_amount ?? old('total_reservation_amount') }}" showDiv=false />
            </div>

            <div class="col mb-3">
                <x-form.label for="advance_reservation_payment" label="{{ localize('Advance Reservation Payment') }}" />
                <x-form.input name="advance_reservation_payment" id="advance_reservation_payment" type="number" step="0.01" placeholder="{{ localize('Advance Reservation Payment') }}" value="{{ $reservation->advance_reservation_payment ?? old('advance_reservation_payment') }}" showDiv=false />
            </div>

        </div>

        <div class="row">
            <div class="col mb-3">
                <x-form.label for="is_paid" label="{{ localize('Is Paid') }}" />

                <x-form.select name="is_paid" id="is_paid">
                    @foreach (appStatic()::IS_PAID_STATUS_ARR as $isPaidStatusId => $isPaidStatus)
                        
                        @if (isset($reservation))
                            <option value="{{ $isPaidStatusId }}" {{ (old('is_paid') ?? $reservation->is_paid) == $isPaidStatusId ? 'selected' : '' }}>{{ $isPaidStatus }}</option>
                        @else
                            <option value="{{ $isPaidStatusId }}">{{ $isPaidStatus }}</option>
                        @endif                       
                    @endforeach
                </x-form.select>
            </div>                        


            <div class="col mb-3">
                <x-form.label for="status_id" label="{{ localize('Status') }}" />
                <x-form.select name="status_id" id="status_id">
                    <option value="">{{ localize('Select a status') }}</option>
                    @foreach (getSelectableStatuses('reservation_access', 1) ?? [] as $reservationsStatusId => $reservationsStatus)
                        @if (isset($reservation))
                            <option value="{{ $reservationsStatusId }}" {{ $reservation->status_id == $reservationsStatusId ? 'selected' : '' }}>{{ $reservationsStatus }}</option>
                        @else
                            <option value="{{ $reservationsStatusId }}">{{ $reservationsStatus }}</option>
                        @endif

                    @endforeach
                </x-form.select>
            </div>
        </div>
    </div>

    <div class="float-end mb-3">
        <div class="d-flex gap-3">
            {{-- <x-form.button>{{ localize('Save') }}</x-form.button> --}}

            <input type="submit" id="reservationBtn" value="{{ localize('Save & New') }}" class="btn btn-primary">`
            <x-form.button color="secondary" type="reset">{{ localize('Reset') }}</x-form.button>
        </div>
    </div>
</div>
