@extends('layouts.setup')
@section('contents')
    <div class="container h-100 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="h3">Checking file permissions</h1>
                        <p class="mb-0">We scanned your server.<br>
                            If everything has green check mark, you are good to go to the next step.</p>
                    </div>

                    <div class="card-body">
                        @php
                            $phpVersion = number_format((float) phpversion(), 2, '.', '');
                        @endphp
                        <ul class="list-group list-group-flush">

                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>Php version {{$phpVersion}}</span>

                              
                                @if ($phpVersion >= 8.1)
                                    <i class="las la-check-circle fs-4 text-success"></i>
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>Curl Enabled</span>

                               
                                @if ($permission['curl_enabled'])
                                    <i class="las la-check-circle fs-4 text-success"></i>
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>File Get Contents</span>

                                @if ($permission['file_get_contents'])
                                    <i class="las la-check-circle fs-4 text-success"></i>
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>File Put Contents</span>

                                @if ($permission['file_put_contents'])
                                    <i class="las la-check-circle fs-4 text-success"></i>
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span><b>.env</b> File Permission</span>

                                @php
                                    $phpVersion = number_format((float) phpversion(), 2, '.', '');
                                @endphp
                                @if ($permission['db_file_write_perm'])
                                    <i class="las la-check-circle fs-4 text-success"></i>
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>

                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>Zip/ZipArchive Extension</span>
                                @if(extension_loaded('zip'))
                                    <i class="las la-check-circle fs-4 text-success"></i>                                
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>Fileinfo PHP Extension</span>
                                @if(extension_loaded('fileinfo'))
                                    <i class="las la-check-circle fs-4 text-success"></i>                                
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>Ctype PHP Extension</span>
                                @if(extension_loaded('ctype'))
                                    <i class="las la-check-circle fs-4 text-success"></i>                                
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            


                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>JSON PHP Extension</span>
                                @if(extension_loaded('json'))
                                    <i class="las la-check-circle fs-4 text-success"></i>                                
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>OpenSSL PHP Extension</span>
                                @if(extension_loaded('openssl'))
                                    <i class="las la-check-circle fs-4 text-success"></i>                                
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>Tokenizer PHP Extension</span>
                                @if(extension_loaded('tokenizer'))
                                    <i class="las la-check-circle fs-4 text-success"></i>                                
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span>Mbstring PHP Extension</span>
                                @if(extension_loaded('mbstring'))
                                    <i class="las la-check-circle fs-4 text-success"></i>                                
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                            <li
                                class="list-group-item text-semibold d-flex align-items-center justify-content-between py-2 px-0">
                                <span> <b>RouteServiceProvider.php</b> File Permission</span>

                                @php
                                    $phpVersion = number_format((float) phpversion(), 2, '.', '');
                                @endphp
                                @if ($permission['routes_file_write_perm'])
                                    <i class="las la-check-circle fs-4 text-success"></i>
                                @else
                                    <i class="las la-times-circle text-danger fs-4"></i>
                                @endif
                            </li>
                        </ul>

                        <p class="mt-3 d-flex">
                            <a href="{{ route('installation.init') }}" class="btn btn-secondary me-2"><i
                                    class="las la-arrow-left"></i>
                                Previous</a>
                            @if (
                                    $permission['curl_enabled'] == 1 &&
                                    $permission['file_put_contents'] == 1 &&
                                    $permission['file_get_contents'] == 1 &&
                                    $permission['db_file_write_perm'] == 1 &&
                                    $permission['routes_file_write_perm'] == 1 &&
                                    $phpVersion >= 8.1)
                                <a href="{{ route('installation.dbSetup') }}" class="btn btn-primary">Next <i
                                        class="las la-arrow-right"></i></a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
