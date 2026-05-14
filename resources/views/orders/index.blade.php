@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-center justify-between mb-12">
        <h1 class="text-4xl font-black text-gray-900">Order <span class="text-green-600">History</span></h1>
        <a href="{{ route('home') }}" class="text-green-600 font-bold hover:underline flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Catalog
        </a>
    </div>

    @if($orders->count() > 0)
        <div class="space-y-8">
            @foreach($orders as $order)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-8 py-6 border-b border-gray-100 flex flex-wrap items-center justify-between gap-6">
                        <div class="flex gap-10">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Order Placed</p>
                                <p class="font-bold text-gray-900">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Amount</p>
                                <p class="font-bold text-gray-900">${{ number_format($order->total_amount, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Status</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 capitalize">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Order #</p>
                            <p class="font-bold text-gray-900 uppercase">FF-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100">
                                        @if($item->meal->image_path)
                                            <img src="{{ asset($item->meal->image_path) }}" alt="{{ $item->meal->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300 italic text-[10px]">No Image</div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 leading-tight mb-1">{{ $item->meal->name }}</h4>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} × ${{ number_format($item->unit_price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
            <div class="bg-gray-200 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">No orders yet</h2>
            <p class="text-gray-500 mb-8">When you place an order, it will appear here.</p>
            <a href="{{ route('home') }}" class="inline-flex bg-green-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-green-700 transition">
                Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection
