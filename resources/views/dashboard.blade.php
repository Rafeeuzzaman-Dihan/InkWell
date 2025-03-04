<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    @include('components.navbar')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
        <p class="mb-6 text-gray-700">Welcome to your dashboard!</p>

        <section class="bg-white shadow-md rounded-lg p-4 mb-8">
            <h2 class="text-xl font-semibold mb-2">Profile</h2>
            <ul class="list-disc pl-5">
                <li><strong>Name:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">Edit Profile</a>
                </li>
            </ul>
        </section>

        @if ($user->role === 'admin')
            @include('dashboard.admin')
        @elseif ($user->role === 'author')
            @include('dashboard.author')
        @elseif ($user->role === 'user')
            @include('dashboard.user')
        @endif
    </div>
</body>

</html>
