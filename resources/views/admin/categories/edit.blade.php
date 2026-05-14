<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100 p-8 lg:p-12">
                <form action="{{ route('categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-8">
                        <label for="name" class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Category Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                            class="w-full bg-gray-50 border-gray-100 rounded-2xl px-6 py-4 focus:ring-green-500 focus:border-green-500 transition font-bold text-gray-900 shadow-sm"
                            placeholder="e.g. Weight Loss">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-10">
                        <label for="color" class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-3">Theme Color (Hex)</label>
                        <div class="flex gap-4">
                            <input type="color" name="color_picker" id="color_picker" value="{{ old('color', $category->color) }}"
                                class="h-14 w-20 bg-gray-50 border-gray-100 rounded-xl cursor-pointer p-1"
                                oninput="document.getElementById('color').value = this.value">
                            <input type="text" name="color" id="color" value="{{ old('color', $category->color) }}" required
                                class="flex-grow bg-gray-50 border-gray-100 rounded-2xl px-6 py-4 focus:ring-green-500 focus:border-green-500 transition font-mono font-bold text-gray-900 shadow-sm"
                                placeholder="#000000" maxlength="7">
                        </div>
                        @error('color')
                            <p class="mt-2 text-sm text-red-600 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-gray-600 font-bold transition">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-blue-700 transition shadow-lg hover:shadow-blue-200 active:scale-95 duration-200">
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
