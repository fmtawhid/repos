@extends('layouts.default')

@section('title')
    {{ localize('Subscription Plan Details') }}
@endsection

@section("pagetitle", localize('Plan Details'))
@section('breadcrumb')
    @php
        $breadcrumbItems = [['href' => null, 'title' => localize('Plan Details')]];
    @endphp
    <x-common.breadcumb :items="$breadcrumbItems" />
@endsection


@section('content')

 
@endsection
