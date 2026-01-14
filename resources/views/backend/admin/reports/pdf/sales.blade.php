<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Sales Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Invoice</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Product Total</th>
                <th>Customer</th>
                <th>Payment Method</th>
                <th>Discount</th>
                <th>Order Total</th>
                <th>Paid Amount</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($salesReports as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->invoice_no ?? '-' }}</td>
                    <td>{{ $row->product_name ?? '-' }}</td>
                    <td>{{ $row->product_qty ?? '-' }}</td>
                    <td>{{ $row->product_sub_total ?? ($row->total_amount ?? 0) }}</td>
                    <td>{{ $row->customer_name ?? '-' }}</td>
                    <td>{{ $row->payment_method ?? ($row->payment_methods ?? '-') }}</td>
                    <td>{{ $row->discount_value ?? $row->total_discount ?? 0 }}</td>
                    <td>{{ $row->order_total ?? $row->total_amount ?? 0 }}</td>
                    <td>{{ $row->paid_amount ?? $row->total_paid ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>