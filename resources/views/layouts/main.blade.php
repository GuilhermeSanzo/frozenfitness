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
                    <a href="#" class="text-gray-600 hover:text-green-600 font-medium transition">Meals</a>
                    <a href="#" class="text-gray-600 hover:text-green-600 font-medium transition">Diets</a>
                    <a href="#" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition font-semibold">Login</a>
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
