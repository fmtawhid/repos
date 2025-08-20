@extends('layouts.default')

@section('title')
    {{ localize('Payment Methods') }} {{ getSetting('tab_separator') }} {{ getSetting('system_title') }}
@endsection
@section("pagetitle", localize('Payment Methods'))
@section('breadcrumb')
    @php
    $breadcrumbItems = [['href' => null, 'title' => localize('Payment Methods')]]; @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection

@section('content')
    <section class="tt-section pb-4">
        <div class="container" id="payment-methods">
         


        </div>
    </section>

    @include('backend.admin.payment-method.paymentForm.paypal')
    @include('backend.admin.payment-method.paymentForm.stripe')
    @include('backend.admin.payment-method.paymentForm.paytm')
    @include('backend.admin.payment-method.paymentForm.razorpay')
    @include('backend.admin.payment-method.paymentForm.iyzico')
    @include('backend.admin.payment-method.paymentForm.paystack')
    @include('backend.admin.payment-method.paymentForm.flutterwave')
    
    @include('backend.admin.payment-method.paymentForm.duitku')
    @include('backend.admin.payment-method.paymentForm.yookassa')
    @include('backend.admin.payment-method.paymentForm.molile')
    @include('backend.admin.payment-method.paymentForm.mercadopago')
    @include('backend.admin.payment-method.paymentForm.midtrans')
    @include('backend.admin.payment-method.paymentForm.offline')

@endsection

@section("js")
    @include('common.media-manager.uppyScripts')
    @include('backend.admin.payment-method.js')
@endsection
