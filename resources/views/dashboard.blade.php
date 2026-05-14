<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Hub') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Welcome Message --}}
            <div class="mb-10">
                <h1 class="text-3xl font-black text-gray-900">Welcome back, Admin!</h1>
                <p class="text-gray-500 mt-2">Manage your gourmet inventory and nutritional plans from here.</p>
            </div>

            {{-- Management Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Meals Card --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-8">
                        <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-green-600 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Meals</h3>
                        <p class="text-gray-500 text-sm mb-8 leading-relaxed">
                            Add, edit, or remove gourmet meals. Manage prices and nutritional details.
                        </p>
                        <a href="{{ route('meals.index') }}" class="inline-flex items-center justify-center w-full py-3 px-4 bg-gray-50 text-gray-700 font-bold rounded-xl hover:bg-green-600 hover:text-white transition-all duration-200">
                            Manage Meals
                        </a>
                    </div>
                </div>

                {{-- Diets Card --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-8">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Diets</h3>
                        <p class="text-gray-500 text-sm mb-8 leading-relaxed">
                            Create weekly meal plans and assign meals to specific fitness goals.
                        </p>
                        <a href="{{ url('admin/diets') }}" class="inline-flex items-center justify-center w-full py-3 px-4 bg-gray-50 text-gray-700 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-200">
                            Manage Diets
                        </a>
                    </div>
                </div>

                {{-- Categories Card --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-8">
                        <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-600 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Categories</h3>
                        <p class="text-gray-500 text-sm mb-8 leading-relaxed">
                            Organize your products by type, goal, or special dietary requirements.
                        </p>
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center w-full py-3 px-4 bg-gray-50 text-gray-700 font-bold rounded-xl hover:bg-purple-600 hover:text-white transition-all duration-200">
                            Manage Categories
                        </a>
                    </div>
                </div>

                {{-- Ingredients Card --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 hover:shadow-xl transition-all duration-300 group">
                    <div class="p-8">
                        <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-orange-600 transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Ingredients</h3>
                        <p class="text-gray-500 text-sm mb-8 leading-relaxed">
                            Maintain your base ingredients list and their nutritional values per 100g.
                        </p>
                        <a href="{{ route('ingredients.index') }}" class="inline-flex items-center justify-center w-full py-3 px-4 bg-gray-50 text-gray-700 font-bold rounded-xl hover:bg-orange-600 hover:text-white transition-all duration-200">
                            Manage Ingredients
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
