@extends('layouts.default')

@section('title')
    {{ localize('Duitku Payment') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection

@section('content')
    <section class="tt-error-page tt-blog-section pt-5 position-relative bg-light-subtle">
        <div class="container">
            <div class="row g-3">
                <div class="content-404 text-center h-100 my-auto">
                    <div class="col-12 col-md-6 col-lg-6 mx-auto">
                        <h2 class="text-center">{{ localize('Select Payment Method') }}</h2>
                        <hr>
                        <form action="{{ route('duitku.pay') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="payment_method">{{ localize('Payment Method') }}:</label>
                                @foreach ($methods as $key => $method)
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="payment_method_{{ $key }}" value="{{ $method['code'] }}">
                                        <label for="payment_method_{{ $key }}">
                                            <img class="form-check-label" src="{{ $method['image'] }}"
                                                alt="{{ $method['name'] }}">
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary float-right">{{ localize('Pay Now') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
