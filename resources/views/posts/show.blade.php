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
                    <div class="border-b mb-4 pb-2 comment" id="comment-{{ $comment->id }}">
                        <p class="font-bold">{{ $comment->user->name }}</p>
                        <p class="comment-body" id="comment-body-{{ $comment->id }}">{{ $comment->body }}</p>
                        <p class="text-gray-600">{{ $comment->created_at->format('M d, Y h:i A') }}</p>
                        @if ($comment->user_id === Auth::id())
                            <button class="text-blue-500 edit-comment" data-id="{{ $comment->id }}">Edit</button>
                            <button class="text-red-500 delete-comment" data-id="{{ $comment->id }}">Delete</button>
                        @endif

                        <div class="hidden mt-2 edit-form" id="edit-form-{{ $comment->id }}">
                            <textarea class="border p-2 w-full" id="edit-body-{{ $comment->id }}">{{ $comment->body }}</textarea>
                            <button class="bg-blue-500 text-white update-comment" data-id="{{ $comment->id }}">Update</button>
                            <button class="bg-gray-500 text-white cancel-edit" data-id="{{ $comment->id }}">Cancel</button>
                        </div>
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
        // Function to add event listeners for edit and delete buttons
        function addCommentEventListeners(commentElement) {
            const editButton = commentElement.querySelector('.edit-comment');
            const deleteButton = commentElement.querySelector('.delete-comment');
            const updateButton = commentElement.querySelector('.update-comment');
            const cancelButton = commentElement.querySelector('.cancel-edit');

            // Edit button functionality
            if (editButton) {
                editButton.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-id');
                    document.getElementById(`comment-body-${commentId}`).classList.add('hidden');
                    document.getElementById(`edit-form-${commentId}`).classList.remove('hidden');
                });
            }

            // Delete button functionality
            if (deleteButton) {
                deleteButton.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-id');

                    axios.delete(`/comments/${commentId}`, {
                        data: {
                            _token: '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        document.getElementById(`comment-${commentId}`).remove();
                    })
                    .catch(error => {
                        console.error('Error deleting comment:', error);
                    });
                });
            }

            // Update button functionality
            if (updateButton) {
                updateButton.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-id');
                    const body = document.getElementById(`edit-body-${commentId}`).value;

                    axios.put(`/comments/${commentId}`, {
                        _token: '{{ csrf_token() }}',
                        body: body
                    })
                    .then(response => {
                        document.getElementById(`comment-body-${commentId}`).innerText = body;
                        document.getElementById(`comment-body-${commentId}`).classList.remove('hidden');
                        document.getElementById(`edit-form-${commentId}`).classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error updating comment:', error);
                    });
                });
            }

            // Cancel button functionality
            if (cancelButton) {
                cancelButton.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-id');
                    document.getElementById(`comment-body-${commentId}`).classList.remove('hidden');
                    document.getElementById(`edit-form-${commentId}`).classList.add('hidden');
                });
            }
        }

        // Adding event listeners for existing comments
        document.querySelectorAll('.comment').forEach(comment => {
            addCommentEventListeners(comment);
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
                                            <p class="comment-body" id="comment-body-${response.data.id}">${response.data.body}</p>
                                            <p class="text-gray-600">${response.data.created_at}</p>
                                            <button class="text-blue-500 edit-comment" data-id="${response.data.id}">Edit</button>
                                            <button class="text-red-500 delete-comment" data-id="${response.data.id}">Delete</button>
                                            <div class="hidden mt-2 edit-form" id="edit-form-${response.data.id}">
                                                <textarea class="border p-2 w-full" id="edit-body-${response.data.id}">${response.data.body}</textarea>
                                                <button class="bg-blue-500 text-white update-comment" data-id="${response.data.id}">Update</button>
                                                <button class="bg-gray-500 text-white cancel-edit" data-id="${response.data.id}">Cancel</button>
                                            </div>`;
                    // Append the new comment at the bottom
                    commentsDiv.appendChild(newComment);
                    document.getElementById('body').value = '';

                    // Add event listeners for the new buttons
                    addCommentEventListeners(newComment);
                })
                .catch(error => {
                    console.error('Error submitting comment:', error);
                });
            @else
                window.location.href = '{{ route('login') }}';
            @endauth
        });

        // Like functionality
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
    </script>
</body>

</html>
