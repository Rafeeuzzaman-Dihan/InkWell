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

    <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
        <h2 class="text-3xl font-semibold mb-4 text-gray-800">Manage Posts</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-lg font-medium text-gray-600">Title</th>
                        <th class="px-4 py-2 text-left text-lg font-medium text-gray-600">Author</th>
                        <th class="px-4 py-2 text-left text-lg font-medium text-gray-600">Categories</th>
                        <th class="px-4 py-2 text-center text-lg font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($posts as $post)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="border px-4 py-2 text-gray-700">{{ $post->title }}</td>
                            <td class="border px-4 py-2 text-gray-700">{{ $post->author->name ?? 'N/A' }}</td>
                            <td class="border px-4 py-2 text-gray-700">
                                @foreach($post->categories as $category)
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>
