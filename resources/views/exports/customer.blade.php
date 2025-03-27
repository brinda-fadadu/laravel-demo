<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            @if ($customer->customer)
                <tr>
                    <td>{{ $customer->customer->name }}</td>
                    <td>{{ $customer->customer->email }}</td>
                    <td>+{{ $customer->customer->country_code_id }} {{ $customer->customer->phone_number }}</td>
                    <td>{{ $customer->status }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="3">Customer data not available</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>