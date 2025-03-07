<div class="mt-4">
    <a href="{{ url('admin/user') }}" class="inline-block bg-gray-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-200">
        User Management
    </a>
    <a href="{{ url('admin/categories') }}" class="inline-block bg-emerald-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-emerald-600 transitio duration-200 mt-2">
        Category Management
    </a>
    <a href="{{ url('admin/posts') }}" class="inline-block bg-violet-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-violet-600 transition duration-200 mt-2">
        Post Management
    </a>
</div>

<section class="bg-white shadow-md rounded-lg p-4 mb-8 mt-8">
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
</section>
<section class="bg-white shadow-md rounded-lg p-4">
    <h2 class="text-xl font-semibold mb-4">Create Post</h2>

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

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <x-textbox name="title" placeholder="Enter your post title"
                value="{{ old('title') }}" />
        </div>

        <div class="mb-4">
            <select id="categories" name="categories[]" multiple="multiple"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">

            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea name="content" id="content" rows="4" placeholder="Write your content here..." required
                class="mt-1 p-2 border border-gray-300 rounded-md w-full">{{ old('content') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="mt-1 block w-full text-sm text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
        </div>

        <div class="mb-4">
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Create New Post</button>
        <a href="{{ route('posts.my') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Manage My Posts</a>


    </form>
</section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#categories').select2({
        placeholder: "Select categories",
        allowClear: true
    });
});
</script>
