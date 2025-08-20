@extends('layouts.default')

@section('title')
    {{ localize('Cron List') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Cron List'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Cron List')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <section class="tt-section">
        <div class="container">     

            <div class="row mb-4 g-4">
                <!--left sidebar-->
                <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4" id="section-1">

                                <table class="table tt-footable border-top" data-use-parent-width="true">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="7%">{{ localize('S/L') }}</th>
                                            <th>{{ localize('Name') }}</th>
                                            <th>{{ localize('Command') }}</th>
                                            <th>{{ localize('Example') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                1
                                            </td>

                                            <td class="fw-semibold">
                                                Subscription Auto Active and Expire
                                            </td>
                                            <td>
                                                <h4><code>artisan subscription:expire</code></h4>
                                            </td>
                                            <td>

                                                <code>
                                                    {{ 'cd ' . base_path() . '/ && php artisan subscription:expire >> /dev/null 2>&1' }}
                                                </code>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <!--pagination start-->

                                <!--pagination end-->
                            </div>
                        </div>

                    </div>
                </div>

                <!--right sidebar-->

            </div>
        </div>
    </section>
@endsection
