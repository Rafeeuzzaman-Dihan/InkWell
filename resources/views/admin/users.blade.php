<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>
    <ul>
        @foreach ($users as $user)
            <li>{{ $user->name }} ({{ $user->email }}) - Role: {{ $user->role }}</li>
        @endforeach
    </ul>
</body>
</html>
