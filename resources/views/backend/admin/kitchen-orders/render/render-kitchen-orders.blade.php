@forelse($orders as $key=>$order)
    @php
        $orderProducts = $order->orderProducts;
    @endphp
    <div class="col-lg-4">
        <div class="card bg-light flex-column h-100">
            <div class="card-body">
                <div class="d-flex align-items-center gap-2">
                    <div class="badge bg-dark">
                        <span>{{ localize("Token:") }} </span>
                            <strong class="h3 text-light fw-bold d-block mb-0">{{ $order->id }}</strong>
                    </div>
                    <div class="d-flex flex-column fs-sm">
                        <div><strong>{{ localize("Date:") }}</strong> {{ $order->created_at->format('d M Y') }}</div>
                        <div><strong>{{ localize("Invoice No:") }}</strong> {{ $order->invoice_no }}</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <small>{{ localize("Order") }}</small>
                    <strong class="fs-sm">{{ $orderProducts->count() }} {{ localize("Items") }}</strong>
                </div>
                <div class="table-responsive">
                   <table class="table align-middle table-bordered">
                        <thead>
                            <tr class="fs-sm">
                                <th scope="col">Item Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orderProducts as $orderProduct)
                                @php
                                    $productJson = $orderProduct->product_json;
                                    $productAttributeJson = $orderProduct->product_attribute_json;
                                    $quantity = $orderProduct->qty ?? 1;
                                    $price = $productAttributeJson["price"] ?? 0;
                                    $amount = $quantity * $price;
                                    $productAddons = $orderProduct->product_addons;
                                @endphp
                                <tr>
                                    <td class="flex flex-col p-2">
                                        <div>
                                            {{ $productJson["name"] ?? '' }}
                                        </div>
                                        <small class="text-muted">{{ $productAttributeJson["title"] ?? '' }}</small>
                                         <div>
                                            @if(!empty($productAddons))
                                                <strong class="mt-1">{{ localize("Addons") }}</strong>
                                                @forelse($productAddons as $productAddon)
                                                        <div class="badge bg-soft-dark rounded-pill me-1">
                                                            <span> {{ $productAddon["title"] ?? '' }} </span>
                                                            <span>{{ formatPrice($productAddon["price"] ?? 0) }}</span>
                                                        </div>
                                                    @empty
                                                @endforelse
                                            @endif
                                         </div>
                                    </td>
                                    <td class="p-2">
                                        {{ $quantity }}
                                    </td>
                                    
                                    <td class="p-2">
                                        <select data-order_product_id="{{ $orderProduct->id }}" id="order_product_status_id" class="orderProductStatusId form-select form-select-sm">                                
                                            @foreach(getKitchenStatuses() as $orderProductStatus)
                                                <option
                                                    @selected($orderProduct->status_id == $orderProductStatus->id) value="{{ $orderProductStatus->id }}">
                                                    {{ $orderProductStatus->title }} 
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted text-sm py-4">
                                        {{ localize("No items found.") }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
