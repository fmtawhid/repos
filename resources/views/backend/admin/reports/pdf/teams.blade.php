<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Teams Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Branch</th>
                <th>Created At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($users as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->email ?? '-' }}</td>
                    <td>{{ $row->mobile ?? '-' }}</td>
                    <td>{{ $row->branch->name ?? '-' }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->account_status ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>