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

    <div class="bg-gray-100 md:px-10 px-4 py-12">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-center text-3xl font-extrabold text-gray-800 mb-8">Latest Posts</h2>

            @if ($posts->isEmpty())
                <p class="text-center text-gray-600">No posts available.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-sm:gap-8">
                    @foreach ($posts as $post)
                    <div class="bg-white rounded overflow-hidden shadow-md flex flex-col">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full h-52 object-cover" />
                        @endif

                        <div class="p-6 flex-1">
                            <h3 class="text-lg font-bold text-gray-800 mb-3">{{ $post->title }}</h3>
                            <p class="text-gray-500 text-sm mb-4">{{ Str::limit($post->content, 100) }}</p>

                            <div class="flex justify-between text-red-900 text-sm mb-4">
                                <p>
                                    <strong>{{ $post->likes->count() }}</strong> Likes
                                </p>
                                <p>
                                    <strong>{{ $post->comments->count() }}</strong> Comments
                                </p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center p-6">
                            <a href="{{ route('posts.show', $post->id) }}" class="inline-block px-4 py-2 rounded bg-blue-500 hover:bg-blue-600 text-white text-[13px]">Read More</a>
                            <p class="text-gray-600 text-sm">{{ $post->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>

</html>