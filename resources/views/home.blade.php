<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    @include('components.navbar')

    <div class="container mx-auto py-10">
        <h2 class="text-center text-3xl font-bold mb-8">Latest Posts</h2>

        @if ($posts->isEmpty())
            <p class="text-center text-gray-600">No posts available.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-48 object-cover">
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $post->title }}</h3>

                        <p class="text-gray-600 text-sm mb-4">{{ Str::limit($post->content, 100) }}</p>

                        <p class="text-violet-900 text-sm mb-4">
                            <strong>{{ $post->likes->count() }}</strong> Likes
                        </p>

                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500 hover:underline">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
