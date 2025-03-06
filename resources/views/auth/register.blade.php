<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl max-sm:max-w-lg mx-auto p-6 h-screen flex items-center justify-center">
        <div class="bg-white shadow-md rounded-lg p-8 w-full">
            <div class="text-center mb-12">
                <h1 class="font-bold text-xl">
                    InkWell
                </h1>
                <h4 class="text-blue-700 text-2xl font-bold mt-6">Create your account</h4>
            </div>

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

                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <x-textbox name="name" placeholder="Enter your name" required="true" />
                    </div>
                    <div>
                        <x-textbox name="email" placeholder="Enter your email" type="email" required="true" />
                    </div>
                    <div>
                        <x-textbox name="password" placeholder="Enter your password" type="password" required="true" />
                    </div>
                    <div>
                        <x-textbox name="password_confirmation" placeholder="Confirm password" type="password" required="true" />
                    </div>
                </div>

                <div class="flex items-center justify-center mt-6 mb-8">
                    <label for="role" class="block text-gray-700 mr-4">Select Role</label>
                    <select name="role" id="role" required class="mr-4 block border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="author">Author</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    <button type="submit" class="py-2 px-6 text-sm tracking-wider rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    </script>

</html>
