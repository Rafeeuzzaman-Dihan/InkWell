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
    <h2 class="text-xl font-semibold mb-4">Edit Post</h2>

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" value="{{ $post->title }}" required class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
        </div>
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea name="content" id="content" rows="4" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">{{ $post->content }}</textarea>
        </div>
        <div class="mb-4">
            <label for="categories" class="block text-sm font-medium text-gray-700">Categories</label>
            <select name="categories[]" id="categories" multiple class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->categories->contains($category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image (Optional)</label>
            <input type="file" name="image" id="image" class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
        </div>
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Update Post</button>
    </form>
</section>

</body>
</html>
