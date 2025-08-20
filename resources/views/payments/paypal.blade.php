
@extends('layouts.default')

@section('title')
    {{ localize('Paypal Payment') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
@endsection
@section('content')

<section class="tt-error-page tt-blog-section pt-5 position-relative bg-light-subtle">
    <div class="container">
        <div class="row g-3">
            <div class="content-404 text-center h-100 my-auto">
                <div class="col-12 col-md-6 col-lg-6 mx-auto">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id={{ paymentGatewayValue('paypal', 'PAYPAL_CLIENT_ID') }}&currency={{ $currency }}"></script>

         
<script>

    paypal.Buttons({

    // Order is created on the server and the order id is returned
    createOrder() {
        return fetch("{{ route('create.payPal.order') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        // use the "body" param to optionally pass additional order information
        // like product skus and quantities
        body: JSON.stringify({
            currency: "{{ $currency }}",
            plan_id: {{$package_id}},
        }),
        })
        .then((response) => response.json())
        .then((order) => order.id);
    },

    // Finalize the transaction on the server after payer approval
    onApprove(data) {
        return fetch("{{ route('capture.payPal.order') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            orderID: data.orderID
        })
        })
        .then((response) => response.json())
        .then((response) => {
            if(response.status == 'success'){
                const element = document.getElementById('paypal-button-container');
                element.innerHTML = '<h3>{{__("Thank you for your payment!")}}</h3>';
                setTimeout( function () {
                    location.href = '{{route("dashboard")}}';
                }, 1000 );
            }else{
                console.log(response.status);
            }
        });
    }

    }).render('#paypal-button-container');

</script>

 @endsection