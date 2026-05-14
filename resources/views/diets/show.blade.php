@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    {{-- Diet Header --}}
    <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-sm border border-gray-100 mb-12">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            <div class="max-w-2xl">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-white shadow-sm" style="background-color: {{ $diet->category->color ?? '#10b981' }}">
                        {{ $diet->category->name }}
                    </span>
                </div>
                <h1 class="text-4xl lg:text-5xl font-black text-gray-900 mb-6">{{ $diet->name }}</h1>
                <p class="text-xl text-gray-600 leading-relaxed italic">
                    "{{ $diet->description }}"
                </p>
            </div>
            <div class="bg-green-50 p-8 rounded-2xl text-center">
                <div class="text-5xl font-black text-green-600 mb-2">{{ $diet->meals->count() }}</div>
                <div class="text-green-800 font-bold uppercase tracking-widest text-sm">Target Meals</div>
            </div>
        </div>
    </div>

    {{-- Meal Schedule --}}
    <h2 class="text-3xl font-black text-gray-900 mb-8 px-4">Weekly Schedule</h2>
    <div class="grid grid-cols-1 gap-12">
        @php
            $groupedMeals = $diet->meals->groupBy('pivot.day')->sortKeys();
        @endphp

        @foreach($groupedMeals as $day => $meals)
            <div class="relative">
                <div class="absolute -left-4 top-0 bottom-0 w-1 bg-green-100 rounded-full hidden lg:block"></div>
                <div class="lg:pl-10">
                    <div class="flex items-center mb-8">
                        <div class="bg-green-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center font-black text-xl shadow-lg shadow-green-200 mr-6">
                            {{ $day }}
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Day Plan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($meals as $meal)
                            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition group">
                                <a href="{{ route('meals.show', $meal) }}" class="block h-32 bg-gray-100 relative overflow-hidden">
                                    @if($meal->image_path)
                                        <img src="{{ asset($meal->image_path) }}" alt="{{ $meal->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300 italic text-xs">
                                            No Image
                                        </div>
                                    @endif
                                    <div class="absolute top-2 right-2 bg-white/90 backdrop-blur px-2 py-0.5 rounded-lg text-[10px] font-black text-green-700 shadow-sm">
                                        {{ $meal->total_kcal }} kcal
                                    </div>
                                </a>
                                <div class="p-6">
                                    <div class="flex items-start justify-between mb-4">
                                        <h4 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition line-clamp-1">
                                            <a href="{{ route('meals.show', $meal) }}">{{ $meal->name }}</a>
                                        </h4>
                                    </div>
                                <p class="text-sm text-gray-500 line-clamp-2 mb-6">
                                    {{ $meal->description }}
                                </p>
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @foreach($meal->ingredients->take(3) as $ingredient)
                                        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-tighter text-gray-500 bg-gray-50 px-2 py-1 rounded-lg border border-gray-100">
                                            @if($ingredient->image_path)
                                                <img src="{{ asset($ingredient->image_path) }}" alt="" class="w-3 h-3 rounded-full object-cover">
                                            @endif
                                            {{ $ingredient->name }}
                                        </span>
                                    @endforeach
                                    @if($meal->ingredients->count() > 3)
                                        <span class="text-[10px] font-bold uppercase tracking-tighter text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">
                                            +{{ $meal->ingredients->count() - 3 }} more
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('meals.show', $meal) }}" class="w-full inline-flex justify-center items-center py-2 bg-gray-50 text-gray-600 rounded-xl font-bold text-sm hover:bg-green-600 hover:text-white transition">
                                    Meal Details
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
