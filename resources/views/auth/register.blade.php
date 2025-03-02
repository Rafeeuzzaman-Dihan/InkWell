<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white shadow-md rounded-lg p-8 w-96">
            <h2 class="text-center text-2xl font-bold mb-6">Register</h2>

            @if ($errors->any())
                <div class="bg-red-200 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <x-textbox name="name" placeholder="Enter your name" required="true" />
                <x-textbox name="email" placeholder="Enter your email" type="email" required="true" />
                <x-textbox name="password" placeholder="Enter your password" type="password" required="true" />
                <x-textbox name="password_confirmation" placeholder="Confirm your password" type="password" required="true" label="Confirm Password" />

                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Select Role</label>
                    <select name="role" id="role" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="author">Author</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-600 transition duration-200">Register</button>
            </form>
        </div>
    </div>
</body>

</html>
