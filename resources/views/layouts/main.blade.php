<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FrozenFitness</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
    <nav class="bg-white shadow-sm border-b sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="FrozenFitness Logo" class="w-10 h-auto">
                    </a>
                </div>
                
                <div class="hidden sm:flex sm:items-center sm:gap-8">
                    <div class="flex items-center gap-6 border-r border-gray-100 pr-8 mr-2">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 font-medium transition">Home</a>
                        <a href="{{ route('home') }}#catalog" class="text-gray-600 hover:text-green-600 font-medium transition">Meals</a>
                        <a href="{{ route('diets.index') }}" class="text-gray-600 hover:text-green-600 font-medium transition">Diets</a>
                        <a href="{{ route('cart.index') }}" class="flex items-center text-gray-600 hover:text-green-600 font-medium transition relative">
                            Cart
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="absolute -top-2 -right-4 bg-green-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                        @auth
                            <a href="{{ route('orders.index') }}" class="text-gray-600 hover:text-green-600 font-medium transition">My Orders</a>
                        @endauth
                    </div>

                    <div class="flex items-center gap-4">
                        @auth
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('dashboard') }}" class="text-green-600 hover:text-green-700 font-bold transition">Admin Hub</a>
                            @endif
                            
                            <div class="flex items-center gap-3 pl-4 border-l border-gray-100">
                                <span class="text-gray-500 text-sm">Hi, <span class="font-semibold text-gray-800">{{ auth()->user()->name }}</span></span>
                                <form method="POST" action="{{ route('logout') }}" class="flex">
                                    @csrf
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-green-600 font-medium transition">Login</a>
                            <a href="{{ route('register') }}" class="bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700 transition font-bold shadow-sm">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-6">
                <div class="bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between animate-fade-in-down" role="alert">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-500 text-white rounded-full p-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="font-bold tracking-tight">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-green-400 hover:text-green-600 transition p-1">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-20 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400 mb-2">&copy; {{ date('Y') }} Frozen Fitness Gourmet. All rights reserved.</p>
            <p class="text-zinc-500 text-sm">
                Developed by Guilherme Souza.
                <a href="https://guilhermesanzo.me" class="hover:text-zinc-300 transition-colors ml-1">Return to Hub</a>
            </p>
        </div>
    </footer>
</body>
</html>
