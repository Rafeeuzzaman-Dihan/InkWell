<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">Reset Password</h1>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" id="username" required class="border rounded w-full py-2 px-3 text-gray-700" placeholder="Enter your username">
            </div>

            <div class="mb-4">
                <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <input type="password" name="new_password" id="new_password" required class="border rounded w-full py-2 px-3 text-gray-700" placeholder="Enter new password">
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required class="border rounded w-full py-2 px-3 text-gray-700" placeholder="Confirm new password">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2">Reset Password</button>
            </div>
        </form>
    </div>
</body>

</html>
