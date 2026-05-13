@extends('layouts.main')

@section('content')
<div class="relative bg-green-700 py-24 mb-12 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-5xl font-extrabold text-white mb-6">Healthy Gourmet, <br><span class="text-green-300">Frozen & Ready</span></h1>
        <p class="text-xl text-green-50 max-w-2xl mx-auto mb-10">High-performance nutrition delivered to your door. Fresh ingredients, zero effort.</p>
        <a href="#catalog" class="bg-white text-green-700 px-8 py-4 rounded-full font-bold text-lg hover:bg-green-50 transition shadow-lg">Browse Catalog</a>
    </div>
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
        </svg>
    </div>
</div>

<div id="catalog" class="max-w-7xl mx-auto px-4 pb-20">
    @foreach($categories as $category)
        @if($category->meals->count() > 0)
            <div class="mb-16">
                <div class="flex items-center mb-8">
                    <div class="w-3 h-10 rounded-full mr-4" style="background-color: {{ $category->color }}"></div>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $category->name }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($category->meals as $meal)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                            <a href="{{ route('meals.show', $meal) }}" class="block h-56 bg-gray-200 relative overflow-hidden">
                                @if($meal->image_path)
                                    <img src="{{ $meal->image_path }}" alt="{{ $meal->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 italic">
                                        No Image Available
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-sm font-bold text-green-700 shadow-sm">
                                    {{ $meal->total_kcal }} kcal
                                </div>
                            </a>
                            
                            <div class="p-6">
                                <a href="{{ route('meals.show', $meal) }}">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-600 transition">{{ $meal->name }}</h3>
                                </a>
                                <p class="text-gray-500 text-sm mb-6 line-clamp-2">{{ $meal->description }}</p>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-black text-gray-900">${{ number_format($meal->unit_price, 2) }}</span>
                                    <button class="bg-green-100 text-green-700 p-3 rounded-xl hover:bg-green-600 hover:text-white transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>
@endsection
