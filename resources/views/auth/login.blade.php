<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white shadow-md rounded-lg p-8 w-96">
            <h2 class="text-center text-2xl font-bold mb-6">Login</h2>

            @if ($errors->any())
                <div class="bg-red-200 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <x-textbox name="email" placeholder="Enter your email" label="Email" type="email" required="true" />
                <x-textbox name="password" placeholder="Enter your password" label="Password" type="password" required="true" />

                <button type="submit"
                    class="w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-600 transition duration-200">Login</button>

            </form>
        </div>
    </div>
</body>

</html>
