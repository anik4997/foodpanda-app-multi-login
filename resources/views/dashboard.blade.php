<!DOCTYPE html>
<html>
<head>
    <title>Foodpanda Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body>
        <nav class="navbar navbar-danger bg-danger px-4">
            <span class="navbar-brand text-white">Foodpanda Dashboard</span>
            <form method="POST" action="{{ route('sso.logout') }}">
                @csrf
                <button class="btn btn-light btn-sm">Logout</button>
            </form>
        </nav>

        <div class="container mt-5">
            <div class="card shadow p-4">
                <h4>You are logged in automatically!</h4>
            </div>
        </div>
    </body>
</html>