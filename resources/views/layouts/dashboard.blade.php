<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard - MyTeam</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">MyTeam Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content Area -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar -->
            <ul class="list-group">
                <li class="list-group-item">
{{--                    <a href="{{ route('dashboard') }}">Dashboard</a>--}}
                </li>
                <li class="list-group-item">
                    <a href="{{ route('teams.index') }}">Teams</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('players.index') }}">Players</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('games.index') }}">Matches</a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('club.edit') }}">Club Information</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <!-- Main Content -->
            @yield('content')
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js (Optional, only needed if using Bootstrap JS features) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
