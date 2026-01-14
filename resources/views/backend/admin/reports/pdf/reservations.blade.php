<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Reservations Report</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Reservation Name</th>
                <th>Branch</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($reservations as $row)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $row->name ?? '-' }}</td>
                    <td>{{ $row->branch->name ?? '-' }}</td>
                    <td>{{ $row->start_datetime }}</td>
                    <td>{{ $row->end_datetime }}</td>
                    <td>{{ $row->status->name ?? $row->status_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>