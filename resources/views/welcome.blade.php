<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Home</title>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white shadow-md rounded-lg p-8 w-96 text-center">
            <h1 class="text-2xl font-bold mb-6">Welcome to Our Site</h1>
            <div class="mb-4">
                <a href="{{ route('register') }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                    Register
                </a>
            </div>
            <div>
                <a href="{{ route('login') }}" class="inline-block bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 transition duration-200">
                    Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>
