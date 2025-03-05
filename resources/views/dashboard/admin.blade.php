<section class="bg-white shadow-md rounded-lg p-4 mb-8">
    <h2 class="text-xl font-semibold mb-4">Add Category</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <x-textbox name="name" placeholder="Enter category name" label="Category Name" required="true" />
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
            <textarea name="description" id="description" rows="4"
                class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
        </div>
        <button type="submit"
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Create
            Category</button>
    </form>

    <div class="mt-4">
        <a href="{{ url('admin/user') }}" class="inline-block bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-200">
            User Management
        </a>
        <a href="{{ url('admin/posts') }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 mt-2">
            Post Management
        </a>
    </div>
</section>