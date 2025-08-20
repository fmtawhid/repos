@extends('layouts.default')

@section('title')
    {{ localize('Email Template') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Email Template'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Email Template')]]; @endphp
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
                            <a class="navbar-brand d-lg-none d-md-none" href="#">{{ localize('Email Template') }}</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <div class="list-group" id="list-tab" role="tablist">
                                    @foreach ($emailTemplates as $key => $item)
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
                        @foreach ($emailTemplates as $key => $template)
                            <div class="tab-pane fade {{ $loop->iteration == 1 ? 'show active' : '' }}"
                                id="{{ $key }}">

                                <div class="card">

                                    <div class="card-body">
                                        <h5>{{ $template->name }}</h5>
                                        <div class="tab-content">
                                            <form action="{{ route('admin.email-templates.update', $template->id) }}"
                                                method="POST" class="emailTemplateForm"
                                                id="emailTemplateForm{{ $template->id }}">
                                                @csrf
                                                <div id="editor">
                                                    <div class="mb-3">
                                                        <label for="Variables">{{ localize('Variables') }}</label>
                                                        <span><strong>{{ $template->variables }}</strong></span>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-8">
                                                            <div class="mb-4">
                                                                <label for="subject_{{ $template->id }}"
                                                                    class="form-label">{{ localize('Subject') }}
                                                                </label>
                                                                <input class="form-control" type="text"
                                                                    id="subject_{{ $template->id }}" name="subject"
                                                                    placeholder="{{ localize('Type Subject') }}"
                                                                    value="{{ $template->subject }}" required>


                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="is_active_{{ $template->id }}" class="form-label">
                                                                <input type="checkbox" name="is_active"
                                                                    class="form-check-input me-2"
                                                                    id="is_active_{{ $template->id }}"
                                                                    @if ($template->is_active) checked @endif
                                                                    value="{{ $template->id }}">
                                                                {{ localize('Is Active ?') }}</label>

                                                        </div>
                                                    </div>

                                                    <textarea name="code" id="content_{{ $template->id }}" data-min-height="650" class="editor form-control emailTemplateEditor" cols="30" rows="30">
                                                    {{ $template->code }}
                                                    </textarea>
                                                </div>
                                               
                                                <div class="col-12 mt-4">
                                                    <button type="submit" class="btn btn-sm btn-primary saveEmailtemplateButton">
                                                        {{ localize('Save Configuration') }}
                                                    </button>
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
    @include('backend.admin.emailTemplate.js')
@endsection
