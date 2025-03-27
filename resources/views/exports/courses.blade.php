<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
