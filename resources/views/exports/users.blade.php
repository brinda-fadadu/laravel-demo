<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Status</th>
            @if ($role == 'Customer')
                <th>Blood Group</th>
                <th>Family members</th>
                <th>Current Subscription Plan</th>
            @endif
            @if ($role == 'Nutritionist')
                <th>Experience</th>
                <th>Certificate</th>
                <th>Bank Name</th>
                <th>Account No</th>
                <th>Ifsc Code</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if ($user->country_code_id && $user->phone_number)
                    <td>{!! '+' . $user->country_code_id . ' ' . $user->phone_number !!}</td>
                @else
                    <td></td>
                @endif
                <td>{{ $user->address }}</td>
                <td>{{ $user->status }}</td>
                @if ($role == 'Customer')
                    <td>
                        @if ($user->customerDetail && $user->customerDetail->exists())
                            {{ $user->customerDetail->blood_group }}
                        @endif
                    </td>
                    <td>{{ $user->family_member_count }}</td>
                    <td>
                        @if ($user->userSubscription && $user->userSubscription->exists())
                            ${{ $user->userSubscription->amount }}
                            @if ($user->userSubscription->type == 'monthly')
                                per month
                            @else
                                per year
                            @endif
                        @endif
                    </td>
                @endif
                @if ($role == 'Nutritionist')
                    <td>
                        @if ($user->nutrition && $user->nutrition->exists())
                            {{ $user->nutrition->total_experience }}
                        @endif
                    </td>
                    <td>
                        @if ($user->nutrition && $user->nutrition->exists())
                            {{ $user->nutrition->certificate_url }}
                        @endif
                    </td>
                    @if ($user->bankDetails && $user->bankDetails->exists())
                        <td>{{ $user->bankDetails->name }}</td>
                        <td>{{ $user->bankDetails->account_number }}</td>
                        <td>{{ $user->bankDetails->ifsc_code }}</td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
