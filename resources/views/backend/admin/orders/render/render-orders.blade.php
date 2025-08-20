@forelse($orders as $key=>$order)
    @php
        $orderProducts = $order->orderProducts;
    @endphp
    <div class="col-lg-4">
        <div class="card bg-light">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">
                    <div class="d-flex gap-2">
                        <div class="badge bg-dark">
                            <span>{{ localize("Token:") }} </span>
                             <strong class="h3 text-light fw-bold d-block mb-0">{{ $order->id }}</strong>
                        </div>
                        <div class="d-flex flex-column fs-sm">
                            <div><strong>{{ localize("Date:") }}</strong> {{ $order->created_at->format('d M Y') }}</div>
                            <div><strong>{{ localize("Invoice No:") }}</strong> {{ $order->invoice_no }}</div>
                            <div><strong>{{ localize("Table No:") }}</strong> <span class="badge bg-soft-primary">{{ $order->table?->table_code ?? 'No Table' }}</span> </div>
                        </div>
                        
                    </div>
                    <div class="text-end d-flex flex-column gap-2">
                        <span class="badge bg-{{ isPaid($order->is_paid) ? 'soft-info': 'soft-danger' }}">{{ isPaid($order->is_paid) ? 'Paid' : 'Not Paid' }}</span>
                        <span class="badge bg-{{ in_array($order->status_id, [1, 8, 12]) ? 'success' : 'warning' }}">{{ $order->status?->title ?? 'No Status' }}</span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom mt-3">
                    <small>{{ localize("Order") }}</small>
                    <strong class="fs-sm">{{ $orderProducts->count() }} {{ localize("Items") }}</strong>
                </div>

                <div class="d-flex justify-content-between align-items-center border-bottom">
                    <small>{{ localize("Total Amount") }} </small>
                    <strong class="fs-sm">{{ formatPrice($order->payable_after_discount) }}</strong>

                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom">
                    <small>{{ localize("Payment Method") }}</small> 
                    <strong class="text-uppercase fs-sm">{{ $order->payment_method }}</strong>
                </div>

                <div class="d-flex gap-3 align-items-center mt-4">
                    <button type="button" class="btn btn-sm d-block w-100 btn-primary orderPrint"
                            data-print_route="{{ route('print.invoice', $order->id) }}">
                         <i data-feather="printer" class="me-1 icon-14"></i>{{ localize("Print") }}
                    </button>
                    <button type="button" class="btn btn-sm d-block w-100 btn-secondary" data-bs-target="#order-details-{{ $order->id }}" data-bs-toggle="modal">
                        <i data-feather="eye" class="me-1 icon-14"></i>{{ localize("View Order Details") }}
                    </button>
                </div>
            </div> 
        </div>
    </div>

    <div class="modal fade" id="order-details-{{ $order->id }}" aria-hidden="true" aria-labelledby="order-details-{{ $order->id }}Label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h1 class="modal-title fs-5" id="order-details-{{ $order->id }}Label">
                    <div class="d-flex gap-2">
                        <div class="badge bg-dark">
                            <span>{{ localize("Token:") }} </span>
                             <strong class="h3 text-light fw-bold d-block">{{ $order->id }}</strong>
                        </div>
                        <div class="d-flex flex-column fs-sm">
                            <div><strong>{{ localize("Date:") }}</strong> {{ $order->created_at->format('d M Y') }}</div>
                            <div><strong>{{ localize("Invoice No:") }}</strong> {{ $order->invoice_no }}</div>
                            <div><strong>{{ localize("Table No:") }}</strong> <span class="badge bg-soft-primary">{{ $order->table?->table_code ?? 'No Table' }}</span> </div>
                        </div>
                        
                    </div>
                </h1>
                <div>
                    
                    <div class="d-flex align-items-center">
                        <strong class="me-2">{{ localize("Status") }}:</strong>
                        <select name="status_id" data-order_id="{{ $order->id }}" id="status_id" class="orderStatusId form-select form-select-sm">
                        @foreach(getSelectedStatuses() as $status)
                            <option
                                @selected($order->status_id == $status->id)
                                value="{{ $status->id }}"
                            > {{ $status->title }} </option>
                        @endforeach
                    </select>
                    </div>
                    <button type="button" class="btn-close position-absolute tt-modal-close-icon" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                   <table class="table align-middle">
                        <thead>
                            <tr class="fs-sm">
                                <th scope="col">Item Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Amount</th>
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
                                        {{ formatPrice($price) }}
                                    </td>
                                    
                                    <td class="p-2">
                                        <select data-order_product_id="{{ $orderProduct->id }}" id="order_product_status_id" class="orderProductStatusId form-select form-select-sm">
                                            @foreach(getOrderStatuses() as $orderProductStatus)
                                                <option
                                                    @selected($orderProduct->status_id == $orderProductStatus->id) value="{{ $orderProductStatus->id }}">
                                                    {{ $orderProductStatus->title }} 
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    
                                    <td class="p-2 text-end">
                                        {{ formatPrice($amount) }}
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
                <div class="row justify-content-end">
                    <div class="col-4 ml-auto table-responsive">
                        <table class="table table-clear table-borderless">
                            <tbody>
                                <tr>
                                    <td colspan="3" class="text-start fw-bold text-sm">
                                        {{ localize("Total") }}
                                    </td>
                                    <td class="text-end fw-bold text-sm">
                                        {{ formatPrice($order->payable_after_discount) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row justify-content-between align-items-center">
                    <div class="flex-grow-1 col-auto">
                        <button type="button" class="col-auto btn btn-sm d-block w-100 btn-primary orderPrint"
                            data-print_route="{{ route('print.invoice', $order->id) }}">
                            <i data-feather="printer" class="me-1 icon-14"></i>{{ localize("Print") }}
                        </button>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <span class="me-2">{{ localize("Payment Status") }}:</span> 
                        <select name="is_paid" data-order_code="{{ $order->invoice_no }}" data-amount="{{ $order->payable_after_discount }}" id="is_paid" class="orderPaymentStatus form-select form-select-sm w-200px" @if ($order->is_paid == 1) disabled @endif>
                            <option value="1" @if($order->is_paid == 1) selected @endif> {{ localize("Paid") }} </option> 
                            <option value="0" @if($order->is_paid == 0) selected @endif> {{ localize("Not Paid") }} </option> 
                        </select>
                    </div>
                </div>
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
