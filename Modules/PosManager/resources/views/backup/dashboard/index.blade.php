@extends('layouts.default')

@section('content')


    <!-- Page Header  -->
    <div class="tt-page-header py-4">
        <div class="container-fluid">
            <div class="row g-2 align-items-center">
                <div class="col-auto flex-grow-1">
                    <div class="tt-page-title">
                        <h1 class="h4 mb-lg-1">Product Listing</h1>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-secondary btn-sm">
                        <i data-feather="cloud" class="icon-14"></i>
                        Draft Order
                    </button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-secondary btn-sm">
                        <i data-feather="codesandbox" class="icon-14"></i>
                        QR Order
                    </button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-secondary btn-sm">
                        <i data-feather="octagon" class="icon-14"></i>
                        Table Order
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header  -->

    <!-- Pos Content -->
    <section class="tt-pos-area pb-4">
        <div class="container-fluid">
            <div class="row g-3">
                <!--left sidebar start-->
                @include("posmanager::dashboard.left._left_pos_dashboard")

                <!--left sidebar end-->

                <!--right sidebar start-->
                @include("posmanager::dashboard.right._right_pos_dashboard")
                <!--right sidebar end-->

            </div>
        </div>
    </section>
    <!-- /Pos Content -->
@endsection
