@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', localize("Sorry, we can't find the page you're looking for. It might have been moved or deleted."))
