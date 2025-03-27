<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Course</th>
            <th>Cuisine</th>
            <th>Preperation Time</th>
            <th>Serving People</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recipes as $recipe)
            @php
                $time = $recipe->prep_time; // Your time string
                [$hours, $minutes] = array_map('intval', explode(':', $time));

                // Create the formatted time string
                $formattedTime = ($hours !== 0 ? $hours . 'h ' : '') . $minutes . 'min';
            @endphp
            
            <tr>
                <td>{{ $recipe->id }}</td>
                <td>{{ $recipe->name }}</td>
                <td>{{ $recipe->type }}</td>
                <td>{{ $recipe->category->name }}</td>
                <td>{{ $recipe->cuisine->name }}</td>
                <td>{{ $formattedTime }}</td>
                <td>{{ $recipe->serving_people }}</td>
                <td>{{ $recipe->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
