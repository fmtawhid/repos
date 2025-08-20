@extends('layouts.default')

@section('title')
    {{ localize('Send Bulk Emails') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Send Bulk Emails'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => 'Send Bulk Emails']]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <section class="tt-section">
        <div class="container">  
            <div class="row g-4">
               
                <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
                    <form action="{{ route('admin.newsletters.send') }}" id="bulkSendMessage" method="POST" enctype="multipart/form-data"
                        class="pb-650">
                        @csrf
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>

                                <input type="hidden" name="user_emails[]">
                                <div class="d-none">
                                    <label for="user_emails" class="form-label">{{ localize('Select Users') }}</label>
                                    <select class="form-select form-control select2"
                                        data-placeholder="{{ localize('Select Users') }}" data-toggle="select2"
                                        name="user_emails[]" multiple>
                                        @foreach ($users as $user)
                                            @if ($user->email)
                                                <option value="{{ $user->email }}">
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-4">
                                    <label for="subscriber_emails" class="form-label">{{ localize('Subscribers') }}</label>
                                    <select class="form-select form-control select2" id="subscriber_emails"
                                        data-placeholder="{{ localize('Select Subscribers') }}" data-toggle="select2"
                                        name="subscriber_emails[]" multiple required>
                                        @foreach ($subscribers as $subscriber)
                                            @if ($subscriber->email)
                                                <option value="{{ $subscriber->email }}">
                                                    {{ $subscriber->email }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                        <label class="form-check-label"
                                            for="selectAll">{{ localize('Select All') }}</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="subject" class="form-label">{{ localize('Email Subject') }}</label>
                                    <input type="text" name="subject" id="subject" class="form-control" required>
                                </div>

                                <div class="mb-4">
                                    <label for="content" class="form-label">{{ localize('Email Body') }}</label>
                                    <textarea id="content" class="editor form-control" name="content"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <button class="btn btn-primary" id="frmActionBtn" type="submit">
                                <i data-feather="save" class="me-1"></i> {{ localize('Send Emails') }}
                            </button>
                        </div>
                    </form>
                </div>

               
            </div>
        </div>
    </section>
@endsection
@section('js')
    @include('backend.admin.NewsLetter.js')
@endsection
