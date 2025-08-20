@extends('layouts.default')

@section('title')
    {{ localize('Subscription Plan Details') }}
@endsection

@section('pagetitle', localize('Plan Details'))
@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => localize('Plan Details')]];
    @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection


@section('content')
    <section class="tt-section py-4">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    @include('backend.admin.payment-request.single-plan', [
                        'package' => $history->plan,
                    ])
                </div>
                <div class="col-8 order-2 order-md-2 order-lg-2 order-xl-1">
                    @if(isAdmin() && isPaymentPending($history->payment_status))
                        <span>{{ localize('Do you want to approve or  resubmit?') }}
                            <a href="javascript:void(0);"
                                class="rounded-pill text-capitalize cursor-pointer ms-1 fs-sm text-underline"
                                onclick="handlePackageActive(this)" data-subscription_user_id="{{ $history->id }}">
                                <strong>{{ localize('Active Now') }}</strong></a> <span>{{ localize('Or') }}</span><a
                                href="javascript:void(0);"
                                class="rounded-pill text-capitalize cursor-pointer ms-1 fs-sm text-underline feedbackBackButton"
                                data-subscription_user_id="{{ $history->id }}">
                                <strong>{{ localize('Resubmit Request') }}</strong></a>
                        </span>
                        <input type="hidden" name="subscription_user_id" value="{{ $history->id }}">
                    @endif

                    <div id="offlinePaymentRequestDetails">
                        <!-- Table start -->
                        <div class="card mb-4" id="paymentDetailDiv">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        @if ($history->payment_status)
                                            <tr>
                                                <th>{{ localize('Payment status') }}</th>
                                                <td> <span
                                                        class="badge  rounded-pill text-capitalize {{ getStatusColor($history->payment_status, 'payment') }}">
                                                        {{ getSubscriptionPaymentStatusName($history->payment_status) }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($history->subscription_status)
                                            <tr>
                                                <th>{{ localize('Subscription status') }}</th>
                                                <td> <span
                                                        class="badge  rounded-pill text-capitalize {{ getStatusColor($history->subscription_status, 'subscription') }}">
                                                        {{ getSubscriptionStatusName($history->subscription_status) }}</span>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>{{ localize('Payment Method') }}</th>
                                            <td>{{ $history->offlinePaymentMethod->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ localize('Paid Amount') }}</th>
                                            <td>{{ $history->price }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ localize('Payment Details') }}</th>
                                            <td>
                                                {{ $history->payment_details  }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ localize('Payment Note') }}</th>
                                            <td>{{ $history->note }}</td>
                                        </tr>
                                        @if($history->feedback_note)
                                        <tr>
                                            <th>{{ localize('Feedback Note') }}</th>
                                            <td>{{ $history->feedback_note }}</td>
                                        </tr>
                                        @endif
                                        @if ($history->file)
                                            <tr>
                                                <th>{{ localize('File') }}</th>
                                                <td>
                                                    <img src="{{ asset($history->file) }}" alt=""
                                                        class="img-fluid">
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Table end -->
                        @if (isVendorUserGroup() && $history->feedback_note && $history->payment_status != appStatic()::PLAN_STATUS_ACTIVE)
                            <div class="card mb-4" id="reSubmitDiv">
                                <form action="{{route('admin.payment-requests.reSubmit')}}" method="POST" id="reSubmitForm"  enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="subscription_user_id" value="{{ $history->id }}">
                                    <!--basic information start-->

                                    <div class="card-body">
                                        <h5 class="mb-4">{{ localize('Admin Required') }} <span
                                                class="text-danger ms-1">*</span>
                                        </h5>
                                        <p> {{ $history->feedback_note }} </p>
                                        <hr class="mb-4">
                                        <div class="offline_payment " id="offline_payment">
                                            <div class="mb-4">
                                                <label for="payment_method"
                                                    class="form-label">{{ localize('Payment Method') }}
                                                    <span class="text-danger ms-1">*</span></label>
                                                <select class="form-control select2" id="offline_payment_method"
                                                    name="offline_payment_method" data-toggle="select2">
                                                    <option value="">{{ localize('Select Offline Payment Method') }}
                                                    </option>
                                                    @foreach ($offlinePaymentMethods as $offlinePaymentMethod)
                                                        <option value="{{ $offlinePaymentMethod->id }}"
                                                            {{ $history->offline_payment_id == $offlinePaymentMethod->id ? 'selected' : '' }}>
                                                            {{ $offlinePaymentMethod->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label for="name"
                                                    class="form-label text-center">{{ localize('Description') }}
                                                    <span class="text-danger ms-1">*</span></label>
                                                @foreach ($offlinePaymentMethods as $offlinePaymentMethod)
                                                    <p id="description_{{ $offlinePaymentMethod->id }}"
                                                        class="all-description d-none">
                                                        {{ $offlinePaymentMethod->description }}</p>
                                                @endforeach
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">{{ localize('Payment Details') }} <span
                                                        class="text-danger ms-1">*</span></label>
                                                <textarea class="form-control" name="payment_details" id="payment_details" rows="2"
                                                    placeholder="{{ localize('Type your Payment Details') }}">{{$history->payment_details}}</textarea>
                                                @if ($errors->has('payment_details'))
                                                    <span class="text-danger">{{ $errors->first('payment_details') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">{{ localize('Note') }}</label>
                                                <textarea class="form-control" name="note" id="offline_note" rows="1"
                                                    placeholder="{{ localize('Type your Note') }}">{{ $history->note }}</textarea>
                                                @if ($errors->has('note'))
                                                    <span class="text-danger">{{ $errors->first('note') }}</span>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label for="default_creativity" class="form-label">{{ localize('File') }}
                                                </label>
                                                <br>
                                                @if ($history->file)
                                                    <img src="{{ asset($history->file) }}" alt=""
                                                        class="mb-2 img-fluid">
                                                @endif
                                                <div class="file-drop-area file-upload text-center rounded-3">
                                                    <input type="file" class="file-drop-input" name="file"
                                                        id="offline_file" />
                                                    <div class="file-drop-icon ci-cloud-upload">
                                                        <i data-feather="image"></i>
                                                    </div>
                                                    <p class="text-dark fw-bold mb-2 mt-3">
                                                        {{ localize('Drop your files here or') }}
                                                        <a href="javascript::void(0);"
                                                            class="text-primary">{{ localize('Browse') }}</a>
                                                    </p>
                                                    <p class="mb-0 file-name text-muted">
                                                        <small>* {{ localize('Allowed file types: jpg,png,jpeg') }}
                                                        </small>
                                                    </p>
                                                </div>
                                                @if ($errors->has('file'))
                                                    <span class="text-danger">{{ $errors->first('file') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <!--basic information end-->


                                    <!-- submit button -->
                                    <div class="mb-3">
                                        <x-form.button id="reSubmitButton">{{ localize('Save') }}</x-form.button>
                                    </div>
                                    <!-- submit button end -->

                                </form>
                            </div>
                        @endif
                        <div class="card mb-4 d-none" id="feedbackBack">
                            <div class="card-body">
                                <form action="{{route('admin.payment-requests.feedback')}}" method="POST" id="feedbackSubmitForm">
                                    @csrf
                                    <input type="hidden" name="subscription_user_id" value="{{ $history->id }}">
                                    <div class="mb-3">
                                        <x-form.label for="feedback_note" label="{{ localize('Feedback') }}"
                                            isRequired=true />
                                        <x-form.textarea name="feedback_note" id="feedback_note" type="text"
                                            placeholder="{{ localize('Feedback') }}" value="{{$history->feedback_note}}" showDiv=false />
                                    </div>
                                    <div class="mb-3">
                                        <x-form.button id="feedbackSubmitButton">{{ localize('Save') }}</x-form.button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade" id="activePackageNow" tabindex="-1" aria-labelledby="activePackageNowLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ localize('Active Now Confirmation') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.payment-requests.approve') }}" method="post">
                        @csrf
                        <input type="hidden" name="subscription_user_id" value="{{ $history->id }}">
                        <div class="my-0 carried_over_info">
                            @if (getSetting('carry_forward'))
                                {{ localize('Remaining balance of previous subscription will be added to this Package and previous pacakge will be expired. Start New Package Today, Enjoy !') }}
                            @else
                                {{ localize('Expire Previous Package and Start New package From Now, Enjoy !!') }}
                            @endif
                        </div>
                        <h6 class="my-3">{{ localize('Are you sure to Active this?') }}</h6>

                        <div class="justify-content-center pb-3">
                            <button type="submit" class="btn btn-danger mt-2"
                                data-bs-dismiss="modal">{{ localize('Procced') }}</button>
                            <button type="button" class="btn btn-secondary mt-2"
                                data-bs-dismiss="modal">{{ localize('Cancel') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('backend.admin.payment-request.show-js')
@endsection
