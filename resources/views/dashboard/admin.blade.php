<section class="bg-white shadow-md rounded-lg p-4 mb-8">
    <h2 class="text-xl font-semibold mb-4">Add Category</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <x-textbox name="category_name" placeholder="Enter category name" label="Category Name" required="true" />
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
            <textarea name="description" id="description" rows="4" required
                class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
        </div>
        <button type="submit"
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Create
            Category</button>
    </form>
</section>
