@extends('admin.layouts.admin')

@section('top-header', localize('Update User') )
@section('title', localize('Update User') )


@section('top-actions')
    <a href="{{ route('admin.users.index') }}" class="btn btn-success ms-2">
        <i class="fa fa-arrow-left me-2"></i>
        {{ localize('All Records') }}
    </a>
@endsection

@section('content')
    <div class="row g-3 mb-3">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    @if (errorSession())
                        <div class="row errorMessage">
                            <div class="col-lg-12">
                                <strong class="text-danger  w-100 p-3"><?= errorSession() ?> </strong>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.update',["user"=>$user]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        @include('admin.powerhouse.users.form-user', [
                            'button' => localize("Update"),
                            'cancelRoute' => false,
                        ])
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection

@section("css")
    <link rel="stylesheet"
          type="text/css"
          href="{{ urlVersion("dashboardFiles/css/admin-custom.css") }}"
    />
@endsection



@section("js")
    @include("admin.layouts.select2-core-script")
    <script>
        'use strict';

        let groupPermissionChecked = false;

        $(document).on("click",".groupTitle",function (e) {

            let groupId             = $(this).attr("for");
            let inputWithAttribute  = `input[data-group-id="${groupId}"]`;
            let isTrue              = !groupPermissionChecked;

            let isGroupChecked = $(`#${groupId}`).prop("checked");


            $(inputWithAttribute).each(function() {
                $(this).prop('checked', !isGroupChecked);
            });
        });
    </script>
@endsection
