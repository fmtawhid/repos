@extends('layouts.default')

@section('title')
    {{ localize('MediaManager') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection

@section("pagetitle", localize("Media Manager")) 
    
@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => 'MediaManager']];
    @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div data-type="media-index">
                        @include('common.media-manager.media-manager-content')
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('js')
    @include('common.media-manager.uppyScripts')
    <script>
        "use strict";
        // runs when the document is ready --> for media files
        $(document).ready(function() {
            getMediaFiles();
        });
       
    </script>
@endsection