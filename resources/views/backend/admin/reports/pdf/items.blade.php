<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Items Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Quantity Sold</th>
                <th>Total Income</th>
                <th>Selling Price</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($items as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->item_name ?? $row->name ?? '' }}</td>
                    <td>{{ $row->quantity_sold ?? 0 }}</td>
                    <td>{{ $row->total_income ?? 0 }}</td>
                    <td>{{ $row->selling_price ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>