<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Meal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8 lg:p-12">
                <form action="{{ route('meals.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                        {{-- Left Column: Basic Info --}}
                        <div class="space-y-8">
                            <div>
                                <label for="name" class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Meal Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full bg-gray-50 border-gray-100 rounded-2xl px-6 py-4 focus:ring-green-500 focus:border-green-500 transition font-bold text-gray-900 shadow-sm"
                                    placeholder="e.g. Grilled Salmon">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Category</label>
                                <select name="category_id" id="category_id" required
                                    class="w-full bg-gray-50 border-gray-100 rounded-2xl px-6 py-4 focus:ring-green-500 focus:border-green-500 transition font-bold text-gray-900 shadow-sm">
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="unit_price" class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Unit Price ($)</label>
                                <input type="number" name="unit_price" id="unit_price" value="{{ old('unit_price') }}" required step="0.01" min="0"
                                    class="w-full bg-gray-50 border-gray-100 rounded-2xl px-6 py-4 focus:ring-green-500 focus:border-green-500 transition font-bold text-gray-900 shadow-sm"
                                    placeholder="0.00">
                                @error('unit_price')
                                    <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Description</label>
                                <textarea name="description" id="description" rows="4" required
                                    class="w-full bg-gray-50 border-gray-100 rounded-2xl px-6 py-4 focus:ring-green-500 focus:border-green-500 transition font-bold text-gray-900 shadow-sm"
                                    placeholder="Describe the meal ingredients and benefits...">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_approved" value="1" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600 relative"></div>
                                    <span class="ml-3 text-sm font-black text-gray-400 uppercase tracking-widest">Active & Approved</span>
                                </label>
                            </div>
                        </div>

                        {{-- Right Column: Ingredients --}}
                        <div>
                            <label class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Ingredients Composition</label>
                            <p class="text-xs text-gray-400 mb-6 italic">Enter the quantity in grams for each ingredient included in this meal.</p>
                            
                            <div class="bg-gray-50 rounded-3xl p-6 max-h-[500px] overflow-y-auto border border-gray-100 space-y-4">
                                @foreach($ingredients as $ingredient)
                                    <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-50 shadow-sm group hover:border-green-200 transition">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-900">{{ $ingredient->name }}</span>
                                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $ingredient->kcal_per_100g }} kcal / 100g</span>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <input type="number" name="ingredients[{{ $ingredient->id }}]" 
                                                value="{{ old('ingredients.' . $ingredient->id) }}"
                                                class="w-24 bg-gray-50 border-gray-100 rounded-xl px-3 py-2 text-center font-bold text-gray-900 focus:ring-green-500 focus:border-green-500 transition"
                                                placeholder="0" min="0">
                                            <span class="text-xs font-black text-gray-400">g</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('ingredients')
                                <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-6 pt-10 mt-10 border-t border-gray-50">
                        <a href="{{ route('meals.index') }}" class="text-gray-400 hover:text-gray-600 font-bold transition">
                            Cancel
                        </a>
                        <button type="submit" class="bg-green-600 text-white px-12 py-4 rounded-2xl font-bold text-lg hover:bg-green-700 transition shadow-lg hover:shadow-green-200 active:scale-95 duration-200">
                            Create Meal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
