@extends('layouts.default')

@section('title')
    {{ localize('QR Code List') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Manage QR Code'))

@section('breadcrumb')
@php
    $breadcrumbItems = [
        ["href"  => null, "title" => localize("QR Code List")]
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
                <div class="mb-4 filter_section">                                    
                    {{-- for initially showing data of first area --}}
                    <input type="hidden" id="firstAreaId" value="{{ $areas->first()->id ?? '' }}">

                    @foreach($areas as $index => $area)                                            
                        <a data-area_id="{{ $area->id }}" class="filterQrCodeByAreaId btn btn-sm btn-soft-primary {{ $index == 0 ? 'active' : '' }}" href="javascript:void(0)">
                            {{ $area->name ?? '' }} 
                        </a>
                    @endforeach
                </div>
            
                <div id="qrcode"></div>

                {{-- Show qr codes.. --}}
                <div class="showQrCodeByAreaId">
                    {{-- load data through ajax --}}
                </div>                   
            </div>
        </div>
    </div>
</section>
<!-- /Page Content  -->

<!-- Add User start-->
{{-- @include('backend.admin.qrcodes.create') --}}
<!-- Add User -->

@endsection

@section('js')
    @include('common.media-manager.uppyScripts')
    @include('backend.admin.qrcodes.js')
@endsection

