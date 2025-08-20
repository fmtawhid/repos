@extends('layouts.default')

@section('title')
    {{ localize('Credentials Setup') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Credentials Setup'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Credentials Setup')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <!-- Page Content  -->
    <section class="mb-4">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-4 col-xl-3">
                    <div class="card">
                        <nav class="navbar navbar-expand-md p-0 tt-settings-nav">
                            <a class="navbar-brand d-lg-none d-md-none px-2" href="#">{{localize('Credentials List')}}</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="list-group" id="list-tab" role="tablist">
                                    @foreach ($credentialTabs as $key => $item)
                                        <a class="list-group-item {{ $loop->first ? 'active' : '' }}" data-bs-toggle="list"
                                            href="#{{ $key }}">
                                            <i data-feather="{{ $item['icon'] }}" class="icon-16"></i>
                                            <span class="d-inline-block flex-grow-1">
                                                {{ localize($item['title']) }}
                                            </span>
                                        </a>
                                    @endforeach

                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-md-8 col-xl-9">
                    <div class="tab-content">
                        @foreach ($credentialTabs as $key => $item)
                            <div class="tab-pane fade  {{$loop->first ? 'show active' : ''}}" id="{{$key}}">
                                @include("backend.admin.settings.credential-tab.$key")
                            </div>
                        @endforeach                        
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- /Page Content  -->
@endsection
@section('js')
    @include('backend.admin.settings.js')
@endsection
