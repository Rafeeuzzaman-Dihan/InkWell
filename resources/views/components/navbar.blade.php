<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <a href="{{ route('home') }}" class="text-white text-lg font-bold">InkWell</a>
        </div>
        <div>
            @auth
                <a href="{{ route('dashboard') }}" class="text-white mx-4 hover:underline">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-600 transition duration-200">Logout</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
