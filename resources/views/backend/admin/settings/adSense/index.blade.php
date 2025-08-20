@extends('layouts.default')

@section('title')
    {{ localize('Google Ads') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Google Ads'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Google Ads')]]; @endphp
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
                            <a class="navbar-brand d-lg-none d-md-none" href="#">{{localize('AdSense')}}</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="list-group" id="list-tab" role="tablist">
                                    @foreach ($ad_senses as $key => $item)
                                        <a class="list-group-item {{ $loop->iteration == 1 ? 'active' : '' }}"
                                            data-bs-toggle="list" href="#{{ $key }}">
                                            <i data-feather="chevrons-right" class="icon-16"></i>
                                            <span class="d-inline-block flex-grow-1">
                                                {{ $item->name }}
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
                        @foreach ($ad_senses as $key => $ads)
                            <div class="tab-pane fade {{ $loop->iteration == 1 ? 'show active' : '' }}"
                                id="{{ $key }}">
                               
                                <div class="card">

                                    <div class="card-body">
                                        <h5>{{ $ads->name }}</h5>
                                        <div class="tab-content">
                                            <form action="{{ route('admin.settings.adSense.update', $ads->id) }}" class="adSense-form adSenseForm"
                                                enctype="multipart/form-data" id="adSense-form_{{$ads->id}}">
                                                @csrf
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <x-form.label for="name"
                                                            label="{{ localize('Name') }}" isRequired=true />
                                                        <x-form.input name="name"
                                                            id="name" type="text"
                                                            placeholder="" value="{{$ads->name}}"
                                                            showDiv=false />
                                                    </div>
                                                    <div class="col-md-12">
                                                        <x-form.label for="code"
                                                            label="{{ localize('Code') }}" isRequired=true />
                                                        <x-form.textarea name="code"
                                                            id="code" type="text"
                                                            placeholder="" value="{{$ads->code}}"
                                                            showDiv=false />
                                                    </div>
                                
                                                   
                                                    <div class="col-md-12">
                                                        <x-form.label for="is_active"
                                                            label="{{ localize('is active ?') }}" />
                                                        <x-form.select name="is_active" id="is_active">
                                                            <option value="0" {{$ads->is_active != 1 ? 'selected': ''}}>{{ localize('De-Active') }}</option>
                                                            <option value="1" {{$ads->is_active == 1 ? 'selected': ''}}>{{ localize('Active') }}</option>
                                                        </x-form.select>
                                                    </div>
                                
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-sm btn-primary adSenseSubmitButton">
                                                            {{ localize('Save Configuration') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                
                                        </div>
                                    </div>
                                </div>
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
    @include('backend.admin.settings.adSense.js')
@endsection
