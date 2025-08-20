@forelse($orders as $key=>$order)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> {{ $order->table?->name }} </h3>
                <p>{{ $order->id }}-#{{ $order->invoice_no }}</p>

                <div class="card-tools"> Not Paid</div>
            </div>

            <div class="card-body">

                <select name="status_id" id="" class="orderStatusId form-control">
                    @foreach(getStatuses() as $status)
                        <option
                            @selected($order->status_id == $status->id)
                            value="{{ $status->id }}"
                        > {{ $status->title }} </option>
                    @endforeach
                </select>
                @php
                    $orderProducts = $order->orderProducts;
                @endphp

                <h5 class="border-bottom text-center">Items ({{ $orderProducts->count() }})</h5>

                <div class="row">
                    @forelse($orderProducts as $orderProduct)
                        @php
                            $productJson = $orderProduct->product_json;
                            $productAttributeJson = $orderProduct->product_attribute_json;
                            $productAddons = $orderProduct->product_addons;

                        @endphp

                        <div class="col-lg-12">
                            <p> {{ $productJson["name"] }} </p>
                            <small>{{ $productAttributeJson["title"] }}</small>

                            @if(!empty($productAddons))
                                <h5 class="mt-1">{{ localize("Addons") }}</h5>
                                <ul class="list-group list-group-flush">
                                    @forelse($productAddons as $productAddon)
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span> {{ $productAddon["name"] }} </span>
                                            <span>{{ formatPrice($productAddon["price"]) }}</span>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            @endif
                        </div>
                    @empty
                    @endforelse
                </div>

                <ul class="list-group list-group-flush">

                    @forelse($orderProducts as $orderProduct)
                        @php
                            $productJson = $orderProduct->product_json;
                            $productAttributeJson = $orderProduct->product_attribute_json;
                        @endphp

                        <li class="list-group-item d-flex justify-content-between">
                            <span> {{ $productJson["name"] }} | {{ $productAttributeJson["title"] }}</span>
                            <span>{{ formatPrice($productAttributeJson["price"]) }}</span>
                        </li>
                    @empty
                    @endforelse

                    <li class="list-group-item d-flex justify-content-between">
                        <span> {{ localize("Total Amount") }} </span>
                        <span>{{ formatPrice($order->payable_after_discount) }}</span>
                    </li>
                </ul>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12">
                        <p> {{ localize("Payment Method") }} : <span> {{ localize("Cash") }} </span> </p>
                    </div>
                    <div class="col-md-12">
                        <p> {{ localize("Payment Status") }} : <span> {{ localize("Cash") }} </span> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-lg-12">
        <div class="alert alert-warning text-center" role="alert">
            {{ localize("No Orders Found") }}
        </div>
    </div>
@endforelse
