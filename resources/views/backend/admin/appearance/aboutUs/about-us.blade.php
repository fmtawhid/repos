@extends('layouts.default')

@section('title')
    {{ localize('About Us') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('About Us'))

@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('About Us')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection
@section('pageTitleButtons')
    <div class="col-auto">
        <x-change-language :langkey="$lang_key" />
    </div>
@endsection
@section('content')
    <!-- Page Content  -->
    <section class="mb-4">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-4 col-xl-3">
                    <div class="card">
                        <nav class="navbar navbar-expand-md p-0 tt-settings-nav">
                            <a class="navbar-brand d-lg-none d-md-none" href="#"> {{ localize('About Us') }} </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="list-group" id="list-tab" role="tablist">
                                  
                                        <a class="list-group-item active"
                                            data-bs-toggle="list" href="#aboutUs">
                                            <i data-feather="settings" class="icon-16"></i>
                                            <span class="d-inline-block flex-grow-1">
                                                {{ localize('About Us') }}
                                            </span>
                                        </a>
                                   

                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-md-8 col-xl-9">
                    <div class="tab-content">                        
                            <div class="tab-pane fade show active"
                                id="aboutUs">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <form action="{{ route('admin.settings.store') }}" method="POST" class="copy-write-text-form settingsForm" enctype="multipart/form-data" id="copy-write-text-form">
                                                @csrf
                                                <input type="hidden" name="language_key" id="language_id" value="{{ $lang_key }}">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <h6 class="mb-0 text-center">{{localize('About Us')}}</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <x-form.label for="aboutUsContents" label="{{ localize('About Us') }}" />
                                                        <x-form.textarea name="settings[aboutUsContents]" id="editor" class="editor"
                                                                    type="text"
                                                                    placeholder="{{ localize('write something here ....') }}"
                                                                    value="{!! html_entity_decode(systemSettingsLocalization('aboutUsContents', $lang_key)) !!}"
                                                                    showDiv=false
                                                        />
                                                        
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-sm btn-dark settingsSubmitButton">
                                                            {{ localize('Save Configuration') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

