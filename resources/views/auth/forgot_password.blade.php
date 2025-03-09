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
        <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-8">
            <h1 class="text-4xl font-bold mb-6 text-gray-800 text-center">Reset Password</h1>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" name="username" id="username" required class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter your username">
                </div>

                <div class="mb-4">
                    <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                    <input type="password" name="new_password" id="new_password" required class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Enter new password">
                </div>

                <div class="mb-4">
                    <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:ring-blue-300" placeholder="Confirm new password">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700 transition duration-200">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
