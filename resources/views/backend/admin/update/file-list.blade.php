@extends('layouts.default')

@section('title')
    {{ localize('File Permission Check') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize("Folders"))

@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => localize('File Permission Check')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('pageTitleButtons')
    <div class="col-auto">
        <x-form.button type="button" >
            <i data-feather="settings"></i>{{ localize('System Update') }}
        </x-form.button>
    </div>
@endsection

@section('content')
    <section class="mb-4">
        <div class="container">

            <div class="row g-4">
                <div class="row align-items-center">
                    @if(count($versionLists) == 0)
                        <div class="col-lg-12 mt-4">
                            <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                                {{localize('You have no file permission issues and you are using latest version')}}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="accordion" id="accordionFaq">
                        @isset($versionLists)
                            @php
                                $notWritePerission = [];
                            @endphp
                            @foreach ($versionLists as $key => $detail)
                                @php
                                    $status = isGreater(currentVersion(), $key, true) ?? true;
                                @endphp
                                <div
                                        class="card accordion-item border {{ $status == false ? ' border-success' : 'border-warning' }} {{ $status == true ? 'active' : '' }}">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                                data-bs-target="#accordionFaq_{{ $key }}"
                                                aria-expanded="{{ $loop->iteration == 1 ? 'true' : 'false' }}"
                                                aria-controls="accordionFaq_{{ $key }}">
                                            {{ $key }}
                                        </button>
                                    </h2>

                                    <div id="accordionFaq_{{ $key }}"
                                         class="accordion-collapse collapse {{ $status == true ? 'show' : '' }}"
                                         data-bs-parent="#accordionFaq">
                                        <div class="accordion-body">
                                            <div class=" mb-4" id="section-1">

                                                <div class="">
                                                    <table class="table tt-footable table-bordered table-responsive mt-4"
                                                           data-use-parent-width="true">
                                                        <thead>
                                                        <tr>
                                                            <th class="fw-medium bg-secondary text-center fs-xs">
                                                                {{ localize('S/L') }}</th>
                                                            <th class="fw-medium bg-secondary fs-xs">
                                                                {{ localize('Changes File') }}</th>
                                                            <th class="fw-medium bg-secondary text-center fs-xs">
                                                                {{ localize('Editable?') }}</th>
                                                            <th class="fw-medium bg-secondary fs-xs"><a href=""
                                                                                                        target="_BLANK">How to give permission? <i
                                                                            data-feather="info"
                                                                            class="icon-14 cursor-pointer"></i></a></th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($detail->changed_file_list as $key => $file)
                                                            <tr>
                                                                <td class="text-center fs-xs">
                                                                {{ $key + 1 }}
                                                                <td class="fs-xs">{{ $file }}</td>
                                                                <td class="text-center fs-xs">
                                                                    @if(file_exists(base_path($file)))
                                                                        <i
                                                                                @if (is_writable($file) == true) data-feather="check-circle" class="icon-14 me-2 text-success"
                                                                                @else  data-feather="x-circle" class="icon-14 me-2 text-danger" @endif>
                                                                        </i>
                                                                    @else
                                                                        <span class="fs-sm"> new file </span>
                                                                    @endif
                                                                </td>
                                                                <td class="fs-xs">
                                                                    @if(file_exists(base_path($file)))
                                                                        CMD: <code
                                                                                class="copy-code text-dark bg-secondary p-1 roundered fs-xs">sudo
                                                                            chmod 777 -R {{ $file }}</code> <i
                                                                                data-feather="copy"
                                                                                class="text-primary copy-code-btn icon-14 cursor-pointer"></i>
                                                                        <br>
                                                                    @endif

                                                                </td>


                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


