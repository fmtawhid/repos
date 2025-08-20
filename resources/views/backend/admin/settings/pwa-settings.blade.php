@extends('layouts.default')

@section('title')
    {{ localize('PWA Settings') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('PWA Settings'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('PWA Settings')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <!-- Page Content  -->
    <section class="tt-section">
        <div class="container">
            <div class="row g-3">
                <!--left sidebar-->
                <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1 pb-650">
                    <form action="{{ route('admin.pwa-settings.store') }}" method="POST" enctype="multipart/form-data"
                        class="mb-4">
                        @csrf
                        <div class="card mb-4" id="section-1">
                            <div class="card-body">
                                <h5 class="mb-4">{{ localize('Basic Information') }}</h5>
                                <div class="row">
                                    <input class="form-control form-control-sm" type="hidden" id="start_url"
                                    placeholder="{{ localize('start_url') }}" name="start_url"
                                    value="{{ env('APP_URL') }}">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pwa_url" class="form-label">{{ localize('PWA URL') }}
                                                <span class="text-danger ms-1">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="pwa_url"
                                                placeholder="{{ localize('pwa_url') }}" name="env[PWA_URL]"
                                                value="{{ env('PWA_URL') }}">
                                            @if ($errors->has('pwa_url'))
                                                <span class="text-danger">{{ $errors->first('pwa_url') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ localize('Name') }}
                                                <span class="text-danger ms-1">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="name"
                                                placeholder="{{ localize('Type Customer name') }}" name="name"
                                                value="{{ config('laravelpwa.manifest.name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="short_name" class="form-label">{{ localize('Short Name') }}
                                                <span class="text-danger ms-1">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="short_name"
                                                placeholder="{{ localize('PWA') }}" name="short_name"
                                                value="{{ config('laravelpwa.manifest.short_name') }}">
                                            @if ($errors->has('short_name'))
                                                <span class="text-danger">{{ $errors->first('short_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="background_color"
                                                class="form-label">{{ localize('Background Color') }}
                                                <span class="text-danger ms-1">*</span></label>
                                            <input class="form-control color_field" type="color" id="background_color"
                                                placeholder="{{ localize('PWA') }}" name="background_color"
                                                value="{{ config('laravelpwa.manifest.background_color') }}">
                                            @if ($errors->has('background_color'))
                                                <span class="text-danger">{{ $errors->first('background_color') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="theme_color" class="form-label">{{ localize('Theme Color') }}
                                                <span class="text-danger ms-1">*</span></label>
                                            <input class="form-control color_field" type="color" id="theme_color"
                                                placeholder="{{ localize('PWA') }}" name="theme_color"
                                                value="{{ config('laravelpwa.manifest.theme_color') }}">
                                            @if ($errors->has('theme_color'))
                                                <span class="text-danger">{{ $errors->first('theme_color') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="status_bar" class="form-label">{{ localize('Status Bar') }}
                                                <span class="text-danger ms-1">*</span></label>
                                            <input class="form-control color_field" type="color" id="status_bar"
                                                placeholder="{{ localize('PWA') }}" name="status_bar"
                                                value="{{ config('laravelpwa.manifest.base_color') }}">
                                            @if ($errors->has('status_bar'))
                                                <span class="text-danger">{{ $errors->first('status_bar') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <h5>Icons</h5>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('72x72') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_72"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    <img src="{{ config('laravelpwa.manifest.icons.72x72.path') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_72'))
                                                <span class="text-danger">{{ $errors->first('icon_72') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('96x96') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_96"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    <img src="{{ config('laravelpwa.manifest.icons.96x96.path') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_96'))
                                                <span class="text-danger">{{ $errors->first('icon_96') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('128x128') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_128"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    
                                                    <img src="{{ config('laravelpwa.manifest.icons.128x128.path') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_128'))
                                                <span class="text-danger">{{ $errors->first('icon_128') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('144x144') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_144"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    
                                                    <img src="{{ config('laravelpwa.manifest.icons.144x144.path') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_144'))
                                                <span class="text-danger">{{ $errors->first('icon_144') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('152x152') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_152"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    
                                                    <img src="{{ config('laravelpwa.manifest.icons.152x152.path') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_152'))
                                                <span class="text-danger">{{ $errors->first('icon_152') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('192x192') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_192"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    
                                                    <img src="{{ config('laravelpwa.manifest.icons.192x192.path') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_192'))
                                                <span class="text-danger">{{ $errors->first('icon_192') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('384x384') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_384"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    
                                                    <img src="{{ config('laravelpwa.manifest.icons.384x384.path') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_384'))
                                                <span class="text-danger">{{ $errors->first('icon_384') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('512x512') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_512"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    
                                                    <img src="{{ config('laravelpwa.manifest.icons.512x512.path') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_512'))
                                                <span class="text-danger">{{ $errors->first('icon_512') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('screenshot 540x720') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_512"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    
                                                    <img src="{{ config('laravelpwa.manifest.screenshots.0.src') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_512'))
                                                <span class="text-danger">{{ $errors->first('icon_512') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <div class="h-100">
                                            <label for="favicon" class="form-label">{{ localize('screenshot 720x540') }}</label>
                                            <div class="file-drop-area file-upload text-center rounded-3 h-100 d-flex flex-column">
                                                <input type="file" class="file-drop-input" name="icon_512"
                                                    id="json" />
                                                <div class="file-drop-icon ci-cloud-upload">
                                                    
                                                    <img src="{{ config('laravelpwa.manifest.screenshots.1.src') }}"
                                                        alt="">
                                                </div>
                                                <p class="text-dark fw-bold mb-2 mt-3">
                                                    {{ localize('Drop your files here or') }}
                                                    <a href="javascript::void(0);"
                                                        class="text-primary">{{ localize('Browse') }}</a>
                                                </p>
                                                <p class="mb-0 file-name text-muted">
                                                    <small>* {{ localize('Allowed file types: ') }} .png
                                                    </small>
                                                </p>
                                            </div>
                                            @if ($errors->has('icon_512'))
                                                <span class="text-danger">{{ $errors->first('icon_512') }}</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">
                                <i data-feather="save" class="me-1"></i> {{ localize('Save Configuration') }}
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </section>
    <!-- /Page Content  -->
@endsection

