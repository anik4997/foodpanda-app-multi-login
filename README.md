# Foodpanda App (Laravel) with SSO Integration

This is the **Foodpanda App** which acts as the Client Application for SSO login from the Ecommerce App.

---

## Overview

- Receives JWT token from Ecommerce App
- Verifies token and automatically logs in the user
- Maintains its own session independently
- Dashboard is protected
- Logout only affects Foodpanda session

---

## Architecture
User
↓
Ecommerce App (Port: 8000)
↓ (JWT Token)
Foodpanda App (Port: 8001)

---

## Technologies

- Laravel 12.52.0
- PHP 8+
- MySQL
- JWT Authentication (`tymon/jwt-auth`)
- WAMP/XAMPP (Local Development)

---

## Setup Instructions

### Clone Repo

```bash
git clone foodpanda-app-multi-login
```
### Install Dependencies

```bash
composer install
```
### Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### Update .env for database:

```bash
DB_DATABASE=foodpanda_db
DB_USERNAME=root
DB_PASSWORD=
SESSION_COOKIE=foodpanda_session
```
### JWT Reception & SSO Login:

## User is redirected from Ecommerce with JWT token as query:
```bash
http://127.0.0.1:8001/sso-login?token=JWT_TOKEN

```
## /sso-login route verifies JWT and logs in the user:
```bash
public function ssoLogin(Request $request)
{
    try {

        $payload = JWTAuth::setToken($request->token)->getPayload();

        $email = $payload['email'];
        $name  = $payload['name'];

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => bcrypt('default123')
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');

    } catch (\Exception $e) {
        return "Invalid Token";
    }
}
```
### Dashboard Protection:

```bash
if (!Auth::check()) {
    return redirect('/')->with('error', 'Please login via Ecommerce first.');
}
```
### Logout:
## Independent logout:
```bash
public function ssoLogout(Request $request)
{
    if (Auth::check()) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    return redirect('http://127.0.0.1:8000/login')
        ->with('success', 'You have been logged out successfully.');
}
```

### Run Migrations:

```bash
php artisan serve --port=8000
```
## Security Notes:

- Always verify JWT before creating a session.
- Dashboard and sensitive routes should be protected.
- Keep session cookies separate to avoid conflicts.
- Do not rely on Ecommerce session—each app manages its own session.

## Testing Flow:

- Login to Ecommerce.
- Click "Login to Foodpanda".
- Auto-login should work
- Logout in Ecommerce but Foodpanda session unaffected