@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-center justify-between mb-12">
        <h1 class="text-4xl font-black text-gray-900">Your <span class="text-green-600">Shopping Cart</span></h1>
        <a href="{{ route('home') }}" class="text-green-600 font-bold hover:underline flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Continue Shopping
        </a>
    </div>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-6">
                @foreach($cart as $id => $details)
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex items-center gap-6">
                        <div class="w-32 h-32 bg-gray-100 rounded-2xl overflow-hidden flex-shrink-0">
                            @if($details['image'])
                                <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 italic text-xs">No Image</div>
                            @endif
                        </div>
                        
                        <div class="flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $details['name'] }}</h3>
                            <p class="text-green-600 font-black text-lg">${{ number_format($details['price'], 2) }}</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center bg-gray-50 rounded-xl p-1 border border-gray-100">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="w-16 bg-transparent border-none focus:ring-0 text-center font-bold text-gray-900" onchange="this.form.submit()">
                            </form>

                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="lg:col-span-1">
                <div class="bg-gray-900 rounded-3xl p-8 text-white shadow-2xl sticky top-8">
                    <h2 class="text-2xl font-bold mb-8">Order Summary</h2>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-gray-400">
                            <span>Subtotal</span>
                            <span class="font-bold text-white">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-400">
                            <span>Shipping</span>
                            <span class="font-bold text-green-400">FREE</span>
                        </div>
                        <div class="pt-4 border-t border-gray-800 flex justify-between items-end">
                            <span class="text-lg">Total</span>
                            <span class="text-3xl font-black text-green-500">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button class="w-full bg-green-600 hover:bg-green-500 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-green-900/20 active:scale-[0.98]">
                        Simulate Checkout
                    </button>
                    
                    <p class="mt-6 text-center text-gray-500 text-sm">
                        Secured by Laravel Session Logic™
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
            <div class="bg-gray-200 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-8">Looks like you haven't added any meals yet.</p>
            <a href="{{ route('home') }}" class="inline-flex bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700 transition">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
