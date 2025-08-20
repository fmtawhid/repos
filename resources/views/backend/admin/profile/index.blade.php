@extends('layouts.default')

@section('content')
    <section class="tt-section">
        <div class="container">
            <div class="row mb-3 g-3">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="d-flex flex-wrap aligin-item-center">
                                <div class="me-3">
                                    <div class="avatar avatar-lg tt-avatar-info">
                                        <img class="rounded-circle" width="50" src="{{ avatarImage($user->avatar) }}" alt="avatar" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h2 class="h5 mb-1">{{ $user->getFullNameAttribute() }}</h2>
                                    <ul class="d-flex flex-wrap list-unstyled mb-0">
                                        <li class="me-3"><i data-feather="briefcase"
                                                class="me-1 text-muted icon-14"></i>{{ appStatic()::USER_TYPES[$user->user_type] }}
                                        </li>
                                        @if ($user->mobile_no)
                                            <li class="me-3"><i data-feather="phone-call"
                                            class="me-1 text-muted icon-14"></i>{{ $user->mobile_no }}</li>
                                        @endif

                                        <li class="me-3"><i data-feather="mail"
                                                class="me-1 text-muted icon-14"></i>{{ $user->email }}</li>
                                    </ul>
                                </div>
                            </div>
                            <ul class="nav nav-line-tab fw-semibold">
                                <li class="nav-item">
                                    <a href="#profile"  class="nav-link active ful" data-bs-toggle="tab"
                                    aria-selected="true">
                                        {{ localize('profile') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#changePassword" class="nav-link" data-bs-toggle="tab"
                                    aria-selected="true">
                                        {{ localize('Change Password') }}
                                    </a>
                                </li>
                                @if (isVendorUserGroup())
                                    <li class="nav-item">
                                        <a href="#currentPlanBalance" class="nav-link" data-bs-toggle="tab"
                                        aria-selected="true">
                                            {{ localize('Current Plan Balance') }}
                                        </a>
                                    </li>
                                @endif

                            </ul>

                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="profile">
                                    @include('backend.admin.profile.inc.profile-info')
                                </div>
                                <div class="tab-pane fade" id="changePassword">
                                    @include('backend.admin.profile.inc.change-password')
                                </div>
                                @if (isVendorUserGroup())
                                    <div class="tab-pane fade" id="currentPlanBalance">
                                        @include('backend.admin.profile.inc.current-plan-balance')
                                    </div>
                                @endif
                            </div>

                            <div class="row g-2">

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('js')
    @include('common.media-manager.uppyScripts')
    @include('backend.admin.profile.js')
@endsection
