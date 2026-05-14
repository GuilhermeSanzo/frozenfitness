<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frozen Fitness - Healthy Gourmet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-green-600 tracking-tight">
                        Frozen <span class="text-gray-800">Fitness</span>
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 font-medium transition">Home</a>
                    <a href="{{ route('home') }}#catalog" class="text-gray-600 hover:text-green-600 font-medium transition">Meals</a>
                    <a href="{{ route('diets.index') }}" class="text-gray-600 hover:text-green-600 font-medium transition">Diets</a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('dashboard') }}" class="text-green-600 hover:text-green-700 font-bold transition">Admin Hub</a>
                        @endif
                        
                        <div class="flex items-center gap-4">
                            <span class="text-gray-500 text-sm">Hi, <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span></span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-500 hover:text-red-600 font-medium transition text-sm">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 font-medium transition">Login</a>
                            <a href="{{ route('register') }}" class="bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700 transition font-bold shadow-sm">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-20 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400">&copy; {{ date('Y') }} Frozen Fitness Gourmet. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
