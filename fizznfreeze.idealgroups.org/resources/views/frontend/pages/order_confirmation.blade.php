@extends('frontend.layouts.new-app')

@section('title', 'Order Confirmed - ' . $order->order_number)

@section('content')
<div class="min-h-screen flex flex-col pb-20">
    @include('frontend.partials.page-header', [
        'backHref'  => route('product', ['category' => 'all']),
        'backLabel' => 'Back to Menu',
        'icon'      => '✅',
        'title'     => 'Order Confirmed!',
        'subtitle'  => 'Your order has been received',
        'waveColor' => '#f8f9ff',
    ])


    <!-- Content -->
    <div class="flex-1 px-4 -mt-4">
        <div class="max-w-md mx-auto">
            
            <!-- Order Number Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4 text-center">
                <p class="text-sm text-gray-500 mb-1">Order Number</p>
                <p class="text-3xl font-bold text-primary mb-4">{{ $order->order_number }}</p>
                
                <div class="flex justify-center gap-4">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-500">Table</p>
                        <p class="text-lg font-bold text-gray-800">{{ $order->table_number }}</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-500">Total</p>
                        <p class="text-lg font-bold text-gray-800">₹{{ number_format($order->total, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Status -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Order Status</h2>
                
                <div class="relative">
                    <!-- Status Timeline -->
                    <div class="flex justify-between items-center">
                        @php
                            $statuses = ['pending', 'confirmed', 'completed'];
                            $currentIndex = array_search($order->status, $statuses);
                            $statusLabels = ['Received', 'Confirmed', 'Completed'];
                            $statusIcons = ['📝', '✅', '✨'];
                        @endphp
                        
                        @foreach($statuses as $index => $status)
                            <div class="flex flex-col items-center {{ $index <= $currentIndex ? 'text-primary' : 'text-gray-300' }}">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg {{ $index <= $currentIndex ? 'bg-primary text-white' : 'bg-gray-200' }}">
                                    {{ $statusIcons[$index] }}
                                </div>
                                <p class="text-xs mt-2 {{ $index <= $currentIndex ? 'text-gray-800 font-medium' : 'text-gray-400' }}">
                                    {{ $statusLabels[$index] }}
                                </p>
                            </div>
                            @if($index < count($statuses) - 1)
                                <div class="flex-1 h-1 mx-1 {{ $index < $currentIndex ? 'bg-primary' : 'bg-gray-200' }}"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Order Items</h2>
                
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                            <div class="flex items-center">
                                <span class="w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center text-xs mr-3">
                                    {{ $item->quantity }}
                                </span>
                                <div>
                                    <p class="text-gray-800 font-medium">{{ $item->product_name }}</p>
                                    @if($item->special_instructions)
                                        <p class="text-xs text-gray-500">{{ $item->special_instructions }}</p>
                                    @endif
                                </div>
                            </div>
                            <span class="font-semibold text-gray-800">₹{{ number_format($item->total, 2) }}</span>
                        </div>
                    @endforeach
                </div>
                
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex justify-between text-lg font-bold text-gray-800">
                        <span>Total</span>
                        <span class="text-primary">₹{{ number_format($order->total, 2) }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">
                        Payment: {{ ucfirst($order->payment_status) }} 
                        @if($order->payment_method) ({{ ucfirst($order->payment_method) }}) @endif
                    </p>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-4">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Customer Details</h2>
                <div class="space-y-2">
                    <p class="text-gray-600"><span class="font-medium">Name:</span> {{ $order->customer_name }}</p>
                    <p class="text-gray-600"><span class="font-medium">Mobile:</span> {{ $order->customer_mobile }}</p>
                    @if($order->notes)
                        <p class="text-gray-600"><span class="font-medium">Notes:</span> {{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="space-y-3">
                <a href="{{ route('product', ['category' => 'all']) }}" 
                   class="block w-full bg-gradient-to-r from-primary to-secondary text-white text-center font-bold py-4 px-6 rounded-2xl shadow-lg">
                    Order More
                </a>
                <a href="{{ route('product', ['category' => 'all']) }}" 
                   class="block w-full bg-gray-100 text-gray-800 text-center font-semibold py-4 px-6 rounded-2xl">
                    Back to Home
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
