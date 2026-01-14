<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Item Category Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Total Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($item_categories as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ data_get($row, 'itemCategory.name') ?? $row->item_category_id }}</td>
                    <td>{{ $row->total_quantity ?? 0 }}</td>
                    <td>{{ $row->total_price ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>