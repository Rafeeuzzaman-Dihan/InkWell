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

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Category Management</h1>

        @if(session('success'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white shadow-md rounded-lg">
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('categories.destroy', $categories->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
