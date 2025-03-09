<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    @include('components.navbar')

<section class="bg-white shadow-md rounded-lg p-4">
    <h2 class="text-center text-3xl font-semibold mb-4">My Posts</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    @foreach($posts as $post)
        <div class="mb-4 p-4 border rounded-lg">
            <h3 class="font-bold">{{ $post->title }}</h3>
            <p>{{ Str::limit($post->content, 100) }}</p>
            <a href="{{ route('posts.edit', $post) }}" class="text-blue-500">Edit</a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 ml-4">Delete</button>
            </form>
        </div>
    @endforeach

    @if($posts->isEmpty())
        <p>No posts found.</p>
    @endif
</section>

</body>

</html>
