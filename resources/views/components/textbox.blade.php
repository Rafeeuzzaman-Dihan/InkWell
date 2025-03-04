<div class="mb-4">
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
        class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent {{ $class }}"
        {{ $required ? 'required' : '' }}>
</div>
