@extends('layouts.setup')
@section('contents')
    <div class="container h-100 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="h3">Update System - v1.1.0</h1>
                        <p class="mb-0">Please be careful of the following before proceeding.</p>
                    </div>
                    <div class="card-body pb-4">
                        <ol class="list-group list-group-flush">
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0  text-danger">
                                <span>You must take backup from your server (files & database)</span>

                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">

                                <span>Make sure you have stable internet connection</span>
                            </li>

                         
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">

                                <strong>All the package's model will be set to GPT 3.5 Turbo, you can change them
                                    later</strong>
                            </li>

                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0 text-warning">

                                <span>Do not close the tab while the process is running.</span>
                            </li>
                        </ol>
                        <br>
                        <a href="{{ route('update.complete') }}" class="btn btn-primary">
                            Update Now <i class="las la-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
