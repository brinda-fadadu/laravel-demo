<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Status</th>
            <th>Subscription Type</th>
            <th>Amount</th>
            <th>Amount Type</th>
            <th>Transaction Id</th>
            <th>Transaction type</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->customer->name }}</td>
                <td>{{ $payment->customer->email }}</td>
                <td>{!! '+' . $payment->customer->country_code_id . ' ' . $payment->customer->phone_number !!}</td>
                <td>{{ $payment->customer->status }}</td>
                <td>{{ $payment->type }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->amount_type }}</td>
                <td>{{ $payment->subscription->transaction_id }}</td>
                <td>{{ $payment->subscription->transaction_type }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
