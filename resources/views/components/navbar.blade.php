<nav class="bg-gray-800 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <div>
            <a href="{{ route('home') }}" class="text-white text-lg font-bold flex items-center">
                <i class="fas fa-pencil-alt mr-2"></i> InkWell
            </a>
        </div>
        <div class="flex items-center">
            @auth
                <a href="{{ route('dashboard') }}" class="mx-4">
                    <button class="flex items-center bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                    </button>
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="flex items-center bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 transition duration-200">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>