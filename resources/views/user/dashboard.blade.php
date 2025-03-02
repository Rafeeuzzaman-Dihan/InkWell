<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body>
    <h1>User Dashboard</h1>
    <p>Welcome to the user dashboard!</p>
    <!-- Profile Section -->
    <section class="bg-white shadow-md rounded-lg p-4 mb-8">
        <h2 class="text-xl font-semibold mb-2">Profile</h2>
        <ul class="list-disc pl-5">
            <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
            <li><a href="#" class="text-blue-500 hover:underline">Edit Profile</a></li>
        </ul>
    </section>
</body>

</html>
