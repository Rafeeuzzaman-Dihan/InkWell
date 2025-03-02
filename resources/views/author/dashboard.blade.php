<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @include('components.navbar')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Author Dashboard</h1>
        <p class="mb-6 text-gray-700">Welcome to your author dashboard! Here you can manage your profile and create new posts.</p>

        <!-- Profile Section -->
        <section class="bg-white shadow-md rounded-lg p-4 mb-8">
            <h2 class="text-xl font-semibold mb-2">Profile</h2>
            <ul class="list-disc pl-5">
                <li><strong>Name:</strong> Your Name</li>
                <li><strong>Email:</strong> your.email@example.com</li>
                <li><a href="#" class="text-blue-500 hover:underline">Edit Profile</a></li>
            </ul>
        </section>

        <!-- Create Post Section -->
        <section class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold mb-4">Create Post</h2>
            <p class="mb-4 text-gray-600">Start writing your new post below:</p>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form to create a new post -->
            {{-- <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"> --}}
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter post title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="content" name="content" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" placeholder="Write your post content here..."></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image (optional)</label>
                    <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                </div>

                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Create New Post</button>
            </form>
        </section>
    </div>
</body>
</html>
