<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    @include('components.navbar') <!-- This should be included -->

    <div class="flex flex-col items-center justify-center h-screen">
        <div class="bg-white shadow-md rounded-lg p-8 w-96">
            <h2 class="text-center text-2xl font-bold mb-6">Welcome to Your Homepage!</h2>

            <p class="text-gray-600">This is a simple homepage for all users.</p>
            <p class="text-gray-600">Feel free to explore the available features.</p>
            <p class="text-gray-600">Thank you for logging in!</p>
            
        </div>
    </div>
</body>

</html>
