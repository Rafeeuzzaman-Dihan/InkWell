<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    @include('components.navbar')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
        <p class="mb-6 text-gray-700">Welcome to the admin dashboard!</p>

        <section class="bg-white shadow-md rounded-lg p-4 mb-8">
            <h2 class="text-xl font-semibold mb-2">Profile</h2>
            <ul class="list-disc pl-5">
                <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
                <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                <li><a href="#" class="text-blue-500 hover:underline">Edit Profile</a></li>
            </ul>
        </section>

        <section class="bg-white shadow-md rounded-lg p-4 mb-8">
            <h2 class="text-xl font-semibold mb-4">Create Category</h2>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500"
                        placeholder="Enter category name">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description
                        (optional)</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500"
                        placeholder="Enter category description"></textarea>
                </div>

                <button type="submit"
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Create
                    Category</button>
            </form>
        </section>
    </div>
</body>

</html>
