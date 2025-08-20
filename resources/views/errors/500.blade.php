@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', localize('Oops! Something went wrong on our end. Please try refreshing the page, or come back later.'))
