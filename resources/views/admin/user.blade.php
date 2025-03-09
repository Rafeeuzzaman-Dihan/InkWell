<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">User Management</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.index') }}" method="GET" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name" class="border rounded p-2">
            <button type="submit" class="bg-blue-600 text-white rounded p-2 ml-2">Search</button>
        </form>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-left text-lg font-medium text-gray-600">SL</th>
                        <th class="py-3 px-4 text-left text-lg font-medium text-gray-600">Name</th>
                        <th class="py-3 px-4 text-left text-lg font-medium text-gray-600">Email</th>
                        <th class="py-3 px-4 text-left text-lg font-medium text-gray-600">Role</th>
                        <th class="py-3 px-4 text-center text-lg font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $index => $user)
                        <tr class="hover:bg-gray-100 transition duration-200">
                            <td class="py-3 px-4 border-b text-gray-700">{{ $users->firstItem() + $index }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $user->name }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $user->email }}</td>
                            <td class="py-3 px-4 border-b text-gray-700">{{ $user->role }}</td>
                            <td class="py-3 px-4 border-b text-center">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</body>

</html>
