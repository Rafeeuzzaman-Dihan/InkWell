<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
                <p>Categories:
                    @foreach ($post->categories as $category)
                        {{ $category->name }}@if (!$loop->last), @endif
                    @endforeach
                </p>
                <p>Posted by: {{ $post->user->name }}</p>
                <p>Posted on: {{ $post->created_at->format('M d, Y h:i A') }}</p>
            </div>

            <div class="flex items-center mb-4">
                <button id="like-button" class="mr-4
                    {{ $post->likes->contains('user_id', Auth::id()) ? 'bg-blue-500' : 'bg-gray-300' }}
                    text-white px-4 py-2 rounded-md flex items-center transition duration-300">
                    <i
                        class="fas fa-thumbs-up {{ $post->likes->contains('user_id', Auth::id()) ? 'text-white' : 'text-gray-700' }}"></i>
                </button>
                <p id="like-count" class="text-sm text-gray-600">{{ $post->likes->count() }} Likes</p>
            </div>

            <h3 class="text-xl font-semibold mb-4">Comments</h3>

            <div id="comments">
                @foreach ($post->comments as $comment)
                    <div class="border-b mb-4 pb-2 comment">
                        <p class="font-bold">{{ $comment->user->name }}</p>
                        <p>{{ $comment->body }}</p>
                        <p class="text-gray-600">{{ $comment->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                @endforeach
            </div>

            <form id="comment-form" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700">Comment</label>
                    <textarea name="body" id="body" rows="4" required
                        class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('like-button').addEventListener('click', function () {
            @auth
                axios.post('{{ route('likes.store', $post->id) }}', {
                    _token: '{{ csrf_token() }}'
                })
                    .then(response => {
                        const likeCount = document.getElementById('like-count');
                        const button = document.getElementById('like-button');

                        if (response.data.action === 'liked') {
                            likeCount.innerText = parseInt(likeCount.innerText) + 1 + ' Likes';
                            button.classList.remove('bg-gray-300');
                            button.classList.add('bg-blue-500');
                            button.querySelector('i').classList.remove('text-gray-700');
                            button.querySelector('i').classList.add('text-white');
                        } else {
                            likeCount.innerText = parseInt(likeCount.innerText) - 1 + ' Likes';
                            button.classList.remove('bg-blue-500');
                            button.classList.add('bg-gray-300');
                            button.querySelector('i').classList.remove('text-white');
                            button.querySelector('i').classList.add('text-gray-700');
                        }
                    })
                    .catch(error => {
                        console.error('Error liking the post:', error);
                    });
            @else
                window.location.href = '{{ route('login') }}';
            @endauth
        });

        document.getElementById('comment-form').addEventListener('submit', function (e) {
            e.preventDefault();
            @auth
                const body = document.getElementById('body').value;

                axios.post('{{ route('comments.store', $post->id) }}', {
                    _token: '{{ csrf_token() }}',
                    body: body
                })
                    .then(response => {
                        const commentsDiv = document.getElementById('comments');
                        const newComment = document.createElement('div');
                        newComment.classList.add('border-b', 'mb-4', 'pb-2', 'comment');
                        newComment.innerHTML = `<p class="font-bold">${response.data.user_name}</p>
                                            <p>${response.data.body}</p>
                                            <p class="text-gray-600">${response.data.created_at}</p>`;
                        commentsDiv.prepend(newComment);
                        document.getElementById('body').value = '';
                    })
                    .catch(error => {
                        console.error('Error submitting comment:', error);
                    });
            @else
                window.location.href = '{{ route('login') }}';
            @endauth
        });
    </script>
</body>

</html>
