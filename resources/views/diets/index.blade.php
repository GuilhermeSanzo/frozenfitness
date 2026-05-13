@extends('layouts.main')

@section('content')
<div class="bg-white border-b mb-12">
    <div class="max-w-7xl mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl font-black text-gray-900 mb-4">Complete Nutrition Plans</h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto">Expertly curated meal plans designed to help you reach your specific health and fitness goals with ease.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 pb-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($diets as $diet)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                <div class="h-48 bg-green-50 flex items-center justify-center relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-green-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white shadow-sm" style="background-color: {{ $diet->category->color ?? '#10b981' }}">
                            {{ $diet->category->name }}
                        </span>
                    </div>
                </div>
                
                <div class="p-8 flex-grow flex flex-col">
                    <h3 class="text-2xl font-black text-gray-900 mb-4">{{ $diet->name }}</h3>
                    <p class="text-gray-500 mb-8 line-clamp-3">{{ $diet->description }}</p>
                    
                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                        <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">{{ $diet->meals->count() }} Meals Included</span>
                        <a href="{{ route('diets.show', $diet) }}" class="inline-flex items-center text-green-600 font-bold hover:text-green-700 transition">
                            View Plan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
