@extends('layouts.default')

@section('title')
    {{ localize('Tickets') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
    @endsection
@section("pagetitle", localize('Tickets'))

@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => 'Tickets']]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('pageTitleButtons')
    @if (!isAdmin())
        <div class="col-auto">
            <x-form.button type="button" id="addFrmOffCanvas" data-bs-toggle="offcanvas"
                data-bs-target="#addTicketFormSidebar">
                <i data-feather="plus" class="icon-14"></i>{{ localize('Create Ticket') }}
            </x-form.button>
        </div>
    @endif
@endsection

@section('content')
    <section class="tt-section pb-4">
        <div class="container">


            <div class="row justify-content-between mb-5">
                <div class="{{ isVendorUserGroup() ? 'col-xl-12 col-md-12' : 'col-xl-8 col-md-8' }}">
                    <div class="card" id="listOfTicket">
                        
                    </div>
                </div>
                @if (!isVendorUserGroup())
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="card tt-sticky-sidebar">
                            <div class="card-header">
                                <h5 class="mb-0">{{ localize('All Category') }}</h5>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group mb-0 list-group-flush">
                                    @foreach ($categories as $category)
                                        <a href="" class="">
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="me-auto">
                                                    <div class="fw-bold">{{ $category->name }}</div>
                                                </div>
                                                <span
                                                    class="badge bg-primary rounded-pill">{{ $category->tickets_count }}</span>
                                            </li>
                                        </a>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>


        </div>
    </section>
    @if (!isAdmin())
        @include('backend.admin.support.tickets.add-ticket')
    @endif
@endsection

@section('js')
    @include('common.media-manager.uppyScripts')
    @include('backend.admin.support.tickets.js')
@endsection
