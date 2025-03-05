<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    @include('components.navbar')

<section class="bg-white shadow-md rounded-lg p-4 mb-8">
    <h2 class="text-xl font-semibold mb-4">Create Post</h2>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" placeholder="Enter post title" required class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
        </div>
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea name="content" id="content" rows="4" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Create Post</button>
    </form>
</section>

</body>
</html>
