<div class="mb-4">
    <label for="{{ $id }}" class="block text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
        class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:ring-blue-300 {{ $class }}"
        {{ $required ? 'required' : '' }}>
</div>
