@extends('layouts.setup')
@section('contents')
    <div class="container h-100 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="mar-ver pad-btm text-center">
                            <h1 class="h3">Lisense Verification</h1>
                            <p>Fill this form with valid Purchase Code</p>
                        </div>

                        @if (isset($error))
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <strong>Invalid Purchase Credentials!! </strong>Please check your Codecanyon.
                                    </div>
                                </div>
                            </div>
                        @endif

                        <p class="text-muted font-13">
                        <form method="POST" action="{{ route('installation.purchase_code') }}">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="fw-semibold mb-1" for="purchase_code">Purchase Code <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control" id="purchase_code" name="purchase_code" autocomplete="off" value="" required>
                                <x-error :name="'purchase_code'"/>
                                <small><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-">How to collect purchase code ?</a></small>   
                            </div>
                        
                            <div class="form-group mb-2">
                                <label class="form-label">Server Mode<span
                                    class="text-danger ms-1">*</span> <span class="ms-1 cursor-pointer"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title=""><i
                                        data-feather="help-circle" class="icon-14"></i></span></label>
                                <select class="select2 form-control package_select" data-toggle="select2" name="server_mode" required>
                                    <option value="production">Production</option>
                                    <option value="local">Development</option>
                                </select>
                            </div>
                          
                            <div class="d-flex align-items-center mt-5">
                                <a href="{{ route('installation.checklist') }}" class="btn btn-secondary me-2"><i
                                        class="las la-arrow-left"></i>
                                    Previous</a>
                                <button type="submit" class="btn btn-primary">Continue <i
                                        class="las la-arrow-right"></i></button>
                            </div>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
