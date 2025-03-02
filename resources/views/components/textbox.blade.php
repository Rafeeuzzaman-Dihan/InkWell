<div class="mb-4">
    <label for="{{ $id }}" class="block text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
        class="mt-1 block w-full border border-black rounded-lg p-2 focus:outline-blue-900 {{ $class }}"
        {{ $required ? 'required' : '' }}>
</div>
