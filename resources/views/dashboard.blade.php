<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex flex-col items-center justify-center h-screen">
        <div class="bg-white shadow-md rounded-lg p-8 w-96">
            <h2 class="text-center text-2xl font-bold mb-6">Welcome to Your Dashboard</h2>

            <h3 class="text-lg font-semibold">Hello, {{ auth()->user()->name }}!</h3>
        </div>
    </div>
</body>

</html>
