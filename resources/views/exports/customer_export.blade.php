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
        
    @foreach($customers as $customer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->is_banned == 1 ? 'Deactive' : 'Active' }}</td>
            <td>{{ $customer->plan ? $customer->plan->title:'' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>