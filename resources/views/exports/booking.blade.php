<table>
    <thead>
        <tr>
            @if($role_id == 3)
                <th>Customer Name</th>
                <th>Nutritionist Name</th>
            @else
                <th>Nutritionist Name</th>
                <th>Customer Name</th>
            @endif
            <th>Date</th>
            <th>Time</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
            <tr>
                @if($role_id == 3)
                    <td>{{ $booking->selectedUser->name }}</td>
                    <td>{{ $booking->createdByUser->name }}</td>
                @else
                    <td>{{ $booking->createdByUser->name }}</td>
                    <td>{{ $booking->selectedUser->name }}</td>
                @endif
                <td>{{ $booking->date }}</td>
                <td>{{ $booking->time }}</td>
                <td>{{ $booking->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
