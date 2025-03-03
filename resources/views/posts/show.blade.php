<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                <button id="like-button" class="mr-4
                    {{ $post->likes->contains('user_id', Auth::id()) ? 'bg-red-500' : 'bg-blue-500' }}
                    text-white px-4 py-2 rounded-md">
                    {{ $post->likes->contains('user_id', Auth::id()) ? 'Unlike' : 'Like' }}
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
                    <textarea name="body" id="body" rows="4" required class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('like-button').addEventListener('click', function() {
            axios.post('{{ route('likes.store', $post->id) }}', {
                _token: '{{ csrf_token() }}'
            })
            .then(response => {
                const likeCount = document.getElementById('like-count');
                const button = document.getElementById('like-button');

                if (response.data.action === 'liked') {
                    likeCount.innerText = parseInt(likeCount.innerText) + 1 + ' Likes';
                    button.innerText = 'Unlike';
                    button.classList.remove('bg-blue-500');
                    button.classList.add('bg-red-500');
                } else {
                    likeCount.innerText = parseInt(likeCount.innerText) - 1 + ' Likes';
                    button.innerText = 'Like';
                    button.classList.remove('bg-red-500');
                    button.classList.add('bg-blue-500');
                }
            })
            .catch(error => {
                console.error('Error liking the post:', error);
            });
        });

        document.getElementById('comment-form').addEventListener('submit', function(e) {
            e.preventDefault();
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
        });
    </script>
</body>

</html>
