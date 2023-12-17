
@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Teams</h1>
        <div class="table-responsive">

            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Name</th>
                    {{--                    <th scope="col">Location</th>--}}
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr id={{"row_".$team->id}}>
                        <td><img width="50px" src={{ $team->logo }}></img></td>
                        <td>{{ $team->name }}</td>
                        {{--                        <td>{{ $player->location }}</td>--}}
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- Delete Button (you may want to confirm deletion with JavaScript) -->
                            <form action="{{ route('teams.destroy', $team->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button data-match-id={{$team->id}} type="submit" class="btn btn-danger btn-sm" >Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection

@section('scripts')
    <script>
        function deleteMatch(matchId) {
            // Make an AJAX request for delete
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: 'players/'+matchId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    // Handle the success response
                    console.log('Match deleted successfully:', response);
                    $("#row_"+matchId).remove();
                    // Optionally, update the UI or redirect the user
                },
                error: function(error) {
                    // Handle the error response
                    console.error('Error deleting match:', error);

                    // Optionally, display an error message to the user
                }
            });
        }

        // Add an event listener to the delete button
        $(document).ready(function() {
            $('.deleteMatch').click(function(e) {
                e.preventDefault(); // Prevent the default form submission

                // Get the match ID from the data attribute or other source
                var matchId = $(this).data('match-id');

                // Show a confirmation dialog
                var confirmed = confirm('Are you sure you want to delete this match?');

                // If the user confirms, call the delete function
                if (confirmed) {
                    deleteMatch(matchId);
                }
            });
        });
    </script>
@endsection
