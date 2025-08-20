
@extends('layouts.default')

@section('title')
    {{ localize('Paypal Subscription Payment') }} {{ getSetting('title_separator') }} {{ getSetting('system_title') }}
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
@section('js')
  <script src="https://www.paypal.com/sdk/js?client-id={{ paymentGatewayValue('paypal', 'PAYPAL_CLIENT_ID') }}&vault=true&intent=subscription">

  </script>          
    <script>

      paypal.Buttons({

          createSubscription: function(data, actions) {
              return actions.subscription.create({
                  'plan_id': '{{$product->billing_id}}' 
              });// Creates the subscription
          },

          onApprove: function(data, actions) {


              return fetch("{{ route('paypal.success') }}", {
              method: "POST",
              headers: {
                  "Content-Type": "application/json",
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({
                      paypalSubscriptionID: data.subscriptionID,                 
                      billingPlanId: "{{$product->billing_id}}",
                      package_id: "{{ $package_id }}",
                      productId: "{{$product->product_id}}",
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

      }).render('#paypal-button-container'); // Renders the PayPal button
      </script>

 @endsection