<table class="table align-items-center table-flush">
    <thead class="thead-light">
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Time</th>
        <th scope="col">Location</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->date }}</td>
            <td>{{ $item->time }}</td>
            <td>{{ $item->location }}</td>
            <td>
                <!-- Edit Button -->
                <a href="{{ route('matches.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>

                <!-- Delete Button (you may want to confirm deletion with JavaScript) -->
                <form action="{{ route('matches.destroy', $item->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
