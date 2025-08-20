@extends('layouts.default')

@section('title')
    {{ localize('Tickets') }}
@endsection

@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => $ticket->title]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection


@section('content')
<section class="tt-section pt-4">
    <div class="container">
     

        <div class="row justify-content-between mb-5">
            <div class="col-xl-8 col-lg-8 col-md-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-wrap align-items-center">
                        <h5 class="mb-0">{{ localize('Ticket') }}: #{{ $ticket->id }} {{ $ticket->title }}</h5>
                        @if ($ticket->is_active == 1)
                            <button class="btn btn-primary" id="post_a_reply">{{ localize('Post a Reply') }}</button>
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($ticket->is_active == 1)
                            <div class="reply-ticket d-none" id="post_reply">
                                <form action="{{ route('admin.support-replies.store') }}" method="POST"
                                    enctype="multipart/form-data" class="replyTicketForm" id="replyTicketForm">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                        <div class="mb-3">
                                            <textarea class="editor" name="description"> {{ old('description') }} </textarea>
                                        </div>

                                        <div class="file-drop-area file-upload text-center rounded-3 py-3 mb-4">
                                            <input type="file" class="file-drop-input" name="files" />
                                            <p class="text-dark fw-bold mb-2">
                                                <i data-feather="image" class="me-2"></i>
                                                {{ localize('Drop your files here or') }}
                                                <a href="#" class="text-primary">{{ localize('Browse') }}</a>
                                            </p>
                                            <p class="mb-0 file-name text-muted">
                                                <small>* (Only .jpg, .png, will be accepted) </small>

                                            </p>
                                            @if ($errors->has('files'))
                                                <span class="text-danger">{{ $errors->first('files') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                           
                                            <x-form.button id="frmActionBtn"> {{ localize('Reply Ticket') }}</x-form.button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <ul class="mb-0 list-unstyled tt-reply-list">
                            @foreach ($ticket->replies as $reply)
                                <li class="tt-single-ticket-reply py-4 border-bottom">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar avatar-md flex-shrink-0">
                                            <img class="rounded-circle" src="{{ avatarImage($reply->user->avatar) }}"
                                                alt="avatar"
                                                onerror="this.onerror=null;this.src='{{ avatarImage($reply->user->avatar) }}';">
                                        </div>
                                        <div class="ms-3 w-100">
                                            <div class="d-flex justify-content-between tt-reply-head">
                                                <div class="mb-2">
                                                    <h6 class="mb-0">{{ $reply->user->name }}</h6>
                                                    <span class="text-muted fs-sm">
                                                        {{ date('d-M-y h:i:s A', strtotime($reply->created_at)) }}</span>
                                                </div>

                                                <div class="tt-ticket-edit">
                                                    <button
                                                        class="border-0 p-2 bg-transparent text-muted confirm-delete"
                                                        data-href="{{ route('admin.support-replies.destroy', $reply->id) }}"><i
                                                            data-feather="trash-2"></i></button>
                                                </div>
                                            </div>

                                            <p> {!! $reply->replied !!}</p>
                                            @foreach ($reply->replyImages as $image)
                                                <a href="{{ asset($image->file_path) }}" class="d-block mt-3"
                                                    download="">
                                                    <i data-feather="paperclip"
                                                        class="icon-14 me-2"></i>{{ localize('download') }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <li class="tt-single-ticket-reply py-4 border-bottom">
                                <div class="d-flex align-items-start">
                                    <div class="avatar avatar-md flex-shrink-0">
                                        <img class="rounded-circle"
                                            src="{{ avatarImage($ticket->createdBy->avatar) }}" alt="avatar"
                                            onerror="this.onerror=null;this.src='{{ avatarImage($ticket->createdBy->avatar) }}';">
                                    </div>
                                    <div class="ms-3 w-100">
                                        <div class="d-flex justify-content-between tt-reply-head">
                                            <div class="mb-2">
                                                <h6 class="mb-0">{{ $ticket->createdBy->name }}</h6>
                                                <span
                                                    class="text-muted fs-sm">{{ date('d-M-y h:i:s A', strtotime($ticket->created_at)) }}</span>
                                            </div>
                                            <div class="tt-ticket-edit">

                                            </div>
                                        </div>

                                        {!! $ticket->description !!}
                                        @foreach ($ticket->images as $item)
                                            <a href="{{ asset($item->file_path) }}" class="d-block mt-3"
                                                download="">
                                                <i data-feather="paperclip"
                                                    class="icon-14 me-2"></i>{{ localize('download') }}</a>
                                        @endforeach

                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="card tt-sticky-sidebar">
                    <div class="card-header">
                        <h5 class="mb-0">{{ localize('Ticket Overview') }} #{{ $ticket->id }}</h5>
                    </div>
                    <div class="card-body px-0">
                        <table class="table boder">
                            <tbody>

                                <tr>
                                    <td class="fw-semibold ps-3">{{ localize('Ttile') }}</td>
                                    <td class="text-muted pe-3">{{ $ticket->title }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold ps-3">{{ localize('Created By') }}</td>
                                    <td class="text-muted pe-3"> {{ $ticket->createdBy->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold ps-3">{{ localize('Created At') }}</td>
                                    <td class="text-muted pe-3">
                                        {{ date('d-M-y h:i:s A', strtotime($ticket->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold ps-3">{{ localize('Category') }}</td>
                                    <td class="text-muted pe-3">{{ $ticket->category->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold ps-3">{{ localize('Priority') }}</td>
                                    <td class="text-muted pe-3">{{ $ticket->priority->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold ps-3">{{ localize('Assigned Staff') }}</td>
                                    <td class="text-muted pe-3">
                                        {{ @$ticket->category->staff->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold ps-3">{{ localize('Status') }} </td>

                                    <td class="text-muted pe-3"> {{ $ticket->is_active == 1 ? 'active' : 'closed' }}
                                    </td>
                                </tr>
                                @if (auth()->user()->user_type == 'admin')
                                    <tr>
                                        <td class="fw-semibold ps-3">{{ localize('Closed Ticket') }} </td>

                                        <td class="text-muted pe-3">
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input"
                                                    onchange="updateStatus(this)"
                                                    @if ($ticket->is_active == 0) checked @endif
                                                    value="{{ $ticket->id }}">
                                            </div>
                                        </td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                        @if (isAdmin())
                            <a href="#" class="btn-link text-danger px-3 erase"
                                data-href="{{ route('admin.support-tickets.destroy', $ticket->id) }}"
                                title="{{ localize('Delete This Ticket') }}">
                                {{ localize('Delete This Ticket') }}
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    @include('backend.admin.support.tickets.reply-js')
@endsection
