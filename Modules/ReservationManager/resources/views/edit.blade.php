@extends('layouts.default')

@section('title')
    {{ localize('Reservations List') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection

@section("pagetitle", localize('Edit Reservation'))

@section('breadcrumb')
    @php
        $breadcrumbItems = [
            ["href"  => null, "title" => localize("Edit Reservations")]
        ];
    @endphp

    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <!-- Page Content  -->
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 bg-transparent pb-0">
                            <div class="showLoader"></div>                            
                            <form action="{{ route('reservationmanager.update', ['reservationmanager' => $reservation]) }}" method="POST">                               
                                @csrf
                                @method("PUT")
                                @include('reservationmanager::form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    @include('common.media-manager.uppyScripts')
@endpush
@section('js')
    @include('reservationmanager::js')
@endsection