@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-12">
        {{-- Meal Image --}}
        <div class="w-full lg:w-1/2">
            <div class="bg-gray-200 rounded-3xl overflow-hidden aspect-square relative shadow-lg">
                @if($meal->image_path)
                    <img src="{{ asset($meal->image_path) }}" alt="{{ $meal->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 italic">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        No Image Available
                    </div>
                @endif
                
                <div class="absolute top-6 right-6 bg-white/95 backdrop-blur px-6 py-2 rounded-2xl text-xl font-black text-green-700 shadow-xl border border-green-100">
                    {{ $meal->total_kcal }} kcal
                </div>
            </div>
        </div>

        {{-- Meal Info --}}
        <div class="w-full lg:w-1/2 flex flex-col">
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-white shadow-sm" style="background-color: {{ $meal->category->color ?? '#10b981' }}">
                        {{ $meal->category->name }}
                    </span>
                </div>
                <h1 class="text-4xl lg:text-5xl font-black text-gray-900 mb-6 leading-tight">{{ $meal->name }}</h1>
                <p class="text-xl text-gray-600 leading-relaxed mb-8">
                    {{ $meal->description }}
                </p>
                
                <div class="flex items-center gap-6 mb-10">
                    <span class="text-5xl font-black text-gray-900">${{ number_format($meal->unit_price, 2) }}</span>
                    <div class="h-10 w-px bg-gray-200"></div>
                    @if(session()->has('cart.' . $meal->id))
                        <a href="{{ route('cart.index') }}" class="bg-green-100 text-green-700 px-10 py-4 rounded-2xl font-bold text-lg hover:bg-green-200 transition flex items-center gap-3">
                            Check Cart
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="meal_id" value="{{ $meal->id }}">
                            <button type="submit" class="bg-green-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-green-700 transition shadow-lg hover:shadow-green-200 active:scale-95 duration-200">
                                Add to Cart
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-100 pt-10">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Detailed Ingredients
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($meal->ingredients as $ingredient)
                        <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-100 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                    @if($ingredient->image_path)
                                        <img src="{{ asset($ingredient->image_path) }}" alt="{{ $ingredient->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <span class="font-semibold text-gray-700">{{ $ingredient->name }}</span>
                            </div>
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-lg text-sm font-bold">
                                {{ $ingredient->pivot->quantity_grams }}g
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
