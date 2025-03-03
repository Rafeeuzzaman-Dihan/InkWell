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

            <div class="text-sm text-gray-500 mb-4">
                <p>Category: {{ $post->category }}</p>
                <p>Posted by: {{ $post->user->name }}</p>
                <p>Posted on: {{ $post->created_at->format('M d, Y h:i A') }}</p>
            </div>

            <div class="flex items-center mb-4">
                <form action="{{ $post->likes->contains('user_id', Auth::id()) ? route('likes.destroy', $post->id) : route('likes.store', $post->id) }}" method="POST" class="mr-4">
                    @csrf
                    @if ($post->likes->contains('user_id', Auth::id()))
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Unlike</button>
                    @else
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Like</button>
                    @endif
                </form>
                <p class="text-sm text-gray-600">{{ $post->likes->count() }} Likes</p>
            </div>

            <h3 class="text-xl font-semibold mb-4">Comments</h3>

            @foreach ($post->comments as $comment)
                <div class="border-b mb-4 pb-2">
                    <p class="font-bold">{{ $comment->user->name }}</p>
                    <p>{{ $comment->body }}</p>
                    <p class="text-gray-600">{{ $comment->created_at->format('M d, Y h:i A') }}</p>
                </div>
            @endforeach

            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700">Comment</label>
                    <textarea name="body" id="body" rows="4" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>
