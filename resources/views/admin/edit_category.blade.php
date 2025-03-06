<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @include('components.navbar')

    <section class="bg-white shadow-md rounded-lg p-4 mb-8">
        <h2 class="text-xl font-semibold mb-4">Edit Category</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" required
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                <input type="text" name="description" id="description" value="{{ $category->descripton }}"
                    class="mt-1 p-2 border border-gray-300 rounded-md w-full" />
            </div>
            <button type="submit"
                class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                Update Category
            </button>
        </form>
    </section>
</body>
</html>
