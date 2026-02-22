<!DOCTYPE html>
<html>
<head>
    <title>Login - Foodpanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    <body class="bg-warning-subtle">
        <div class="container vh-100 d-flex justify-content-center align-items-center">
            <div class="card shadow-lg p-5" style="width: 400px;">

                <h3 class="text-center mb-4 text-danger">🍔 Foodpanda Login</h3>

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('foodpanda.login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <button class="btn btn-danger w-100">Login</button>
                </form>

            </div>
        </div>
    </body>
</html>