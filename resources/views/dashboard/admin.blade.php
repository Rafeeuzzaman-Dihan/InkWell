<section class="bg-white shadow-md rounded-lg p-4 mb-8">
    <h2 class="text-xl font-semibold mb-4">Add Category</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <x-textbox name="category_name" placeholder="Enter category name" label="Category Name" required="true" />
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description (optional)</label>
            <textarea id="description" name="description" rows="4"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500"
                placeholder="Enter category description"></textarea>
        </div>
        <button type="submit"
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Create
            Category</button>
    </form>
</section>
