<table>
    <thead>
    <tr>
        <th>SL</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Last/Current Package</th>
    </tr>
    </thead>
    <tbody>
        
    @foreach($merchants as $merchant)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $merchant->name }}</td>
            <td>{{ $merchant->email }}</td>
            <td>{{ $merchant->phone }}</td>
            <td>{{ $merchant->is_banned == 1 ? 'Deactive' : 'Active' }}</td>
            <td>{{ $merchant->plan ? $merchant->plan->title:'' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>