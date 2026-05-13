<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Ingredient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8 lg:p-12">
                <form action="{{ route('ingredients.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-8">
                        <label for="name" class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Ingredient Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full bg-gray-50 border-gray-100 rounded-2xl px-6 py-4 focus:ring-green-500 focus:border-green-500 transition font-bold text-gray-900 shadow-sm"
                            placeholder="e.g. Chicken Breast">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-10">
                        <label for="kcal_per_100g" class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Kcal per 100g</label>
                        <input type="number" name="kcal_per_100g" id="kcal_per_100g" value="{{ old('kcal_per_100g') }}" required step="0.01" min="0"
                            class="w-full bg-gray-50 border-gray-100 rounded-2xl px-6 py-4 focus:ring-green-500 focus:border-green-500 transition font-bold text-gray-900 shadow-sm"
                            placeholder="e.g. 165">
                        @error('kcal_per_100g')
                            <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('ingredients.index') }}" class="text-gray-400 hover:text-gray-600 font-bold transition">
                            Cancel
                        </a>
                        <button type="submit" class="bg-green-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-green-700 transition shadow-lg hover:shadow-green-200 active:scale-95 duration-200">
                            Create Ingredient
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
