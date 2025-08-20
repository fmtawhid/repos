@php
    $fontSize   = getSetting("invoice_font_size", 12);
    $paperWidth = getSetting("invoice_paper_width", 58);
@endphp

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ localize("Invoice") }}</title>
    <style>
        body {
            font-family: monospace;
            font-size: {{ $fontSize }}px;
            width: {{ $paperWidth }}mm;
            padding: 5px;
            margin: 0;
        }

        .center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 5px 0; }
        .bold { font-weight: bold; }
        .item, .total { display: flex; justify-content: space-between; }
        .footer { margin-top: 10px; font-size: 11px; }
    </style>
</head>

<body>

    @php
        $logoMediaManagerId = getSetting("invoice_logo");

        $logoUrl = defaultImage();

        if(!empty($logoMediaManagerId)){
            $mediaManager = getMediaManagerById($logoMediaManagerId);

            if (!empty($mediaManager)) {
                $logoUrl = url($mediaManager->media_file);
            }
        }

    @endphp

    <div class="center bold">
        <img src="{{ $logoUrl }}" alt="">
    </div>
    <div class="center bold">{{ $branch->name }}</div>
    <div class="center">{!! $branch->address !!}</div>
    <div class="center">{{ $branch->mobile_no }}</div>

    <div class="line"></div>
    <div>{{ localize("Date") }}: {{ now()->format('Y-m-d H:i:s A') }}</div>
    <div>{{ localize("Invoice") }} #{{ $order->invoice_no ?? '123456' }}</div>
    <div class="line"></div>

    <div class="bold">{{ localize("Items") }}</div>

    @forelse($order->orderProducts as $orderProduct)
        <div class="item">
            <div>
                {{ $orderProduct->product_json['name'] }}
                {{ $orderProduct->product_attribute_json['title'] }} x{{ $orderProduct['qty'] }}</div>
            <div>{{ formatPrice($orderProduct->total_price) }}</div>

            <hr>
        </div>

        @if(!empty($orderProduct->product_addons))
            @forelse($orderProduct->product_addons as $orderProductAddon)
                <div class="item">
                    <div> {{ $orderProductAddon['title'] }} x1</div>
                    <div>{{ formatPrice($orderProductAddon["price"]) }}</div>
                </div>
            @empty
            @endforelse
        @endif
    @empty
    @endforelse

    @php
        if(isPercentage($order->discount_type)){
            $discountText = $order->discount_value." % ";
        }else{
            $discountText = localize("Flat ")." ".formatPrice($order->discount_value) ;
        }
    @endphp

    <div class="line"></div>
    <div class="total"><span>{{ localize("Subtotal") }}:</span><span>{{ formatPrice($order->total) }}</span></div>
    <div class="total"><span>{{ localize("Tax") }}:</span><span>{{ formatPrice(0) }}</span></div>
    <div class="total"><span>{{ localize("Discount") }}:</span><span>{{ formatPrice($order->discounted_amount) }} ({{ $discountText }})</span></div>
    <div class="total bold"><span>{{ localize("Total") }}:</span><span>{{ formatPrice($order->payable_after_discount) }}</span></div>
    <div class="total"><span>{{ localize("Paid") }}:</span><span>{{ formatPrice($order->paid_amount) }}</span></div>
    <div class="line"></div>

    <div class="center footer">
        {!! getSetting('invoice_thanksgiving')  !!}
    </div>

    <script>
        window.print();

        window.onafterprint = function() {
            window.close();
        };
    </script>

</body>
</html>
