
@extends('layouts.default')

@section('title')
{{ localize('Plan Details') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => 'Admin Customers']];
    @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection



@section('content')
<section class="tt-section pt-4">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <div class="tt-page-header">
                    <div class="d-lg-flex align-items-center justify-content-lg-between">
                        <div class="tt-page-title mb-3 mb-lg-0">
                            <h1 class="h4 mb-lg-1">{{ localize('Plan Details') }}</h1>
                            <ol class="breadcrumb breadcrumb-angle text-muted">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('writebot.dashboard') }}">{{ localize('Dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item">{{ localize('Subscriptions Settings') }}</li>
                            </ol>
                        </div>
                        <div class="tt-action">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 pb-650">         
            <div class="col-xl-12 order-2 order-md-2 order-lg-2 order-xl-1"> 
                <div class="card-body px-0">
                    <table class="table boder">
                      <tbody>
                        
                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Plan ID')}}</td>
                          <td class="text-muted pe-3">{{$details['id']}}</td>
                        </tr>
                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Product ID')}}</td>
                          <td class="text-muted pe-3">{{$details['product_id']}}</td>
                        </tr>
                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Name')}}</td>
                          <td class="text-muted pe-3">{{$details['name']}}</td>
                        </tr>
                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Status')}}</td>
                          <td class="text-muted pe-3">{{$details['status']}}</td>
                        </tr>
                       
                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Description')}}</td>
                          <td class="text-muted pe-3">{{$details['description']}}</td>
                        </tr>
                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Price')}}</td>
                          <td class="text-muted pe-3">{{$details['billing_cycles'][0]['pricing_scheme']['fixed_price']['value']}}</td>
                        </tr>
                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Currency Code')}}</td>
                          <td class="text-muted pe-3">{{$details['billing_cycles'][0]['pricing_scheme']['fixed_price']['currency_code']}}</td>
                        </tr>

                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Frequency')}}</td>
                          <td class="text-muted pe-3">{{$details['billing_cycles'][0]['frequency']['interval_unit']}}</td>
                        </tr>
                        <tr>
                          <td class="fw-semibold ps-3">{{localize('Created Date')}}</td>
                          <td class="text-muted pe-3">{{ date('d-M-y h:i:s A', strtotime($details['create_time'])) }}</td>
                        </tr>
                       
                      
      
                      </tbody>
                    </table>                     
                                        
                    
                   
                  </div>
            </div>
        </div>
    </div>
</section>
@endsection
