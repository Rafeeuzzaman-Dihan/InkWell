<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto py-10">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h2 class="text-2xl font-bold mb-8">{{ $post->title }}</h2>

            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-64 object-cover mb-6">
            @endif

            <div class="text-gray-700 mb-6">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div class="text-sm text-gray-500">
                <p>Category: {{ $post->category }}</p>
                <p>Posted by: {{ $post->user->name }}</p>
                <p>Posted on: {{ $post->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</body>

</html>