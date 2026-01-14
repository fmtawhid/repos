<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Subscriptions Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Package</th>
                <th>Price</th>
                <th>Subscribed On</th>
                <th>Payment Method</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($histories as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->user->name ?? $row->customer->name ?? '-' }}</td>
                    <td>{{ $row->plan->title ?? '-' }}</td>
                    <td>{{ $row->price }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->payment_method ?? ($row->paymentMethod->name ?? '-') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>