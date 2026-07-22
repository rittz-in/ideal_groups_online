@extends('frontend.layouts.new-app')

@section('title','Fizz & Freeze - Cafe')

@section('content')
{{-- OLD CODE START --}}
{{-- 
    Previous home page content with old layout.
    Kept for reference - uses 'frontend.layouts.app'.
    See git history for full old implementation.
--}}
{{-- OLD CODE END --}}

<!-- Hero Section -->
<div class="min-h-screen flex flex-col pb-20">

    <!-- Top decorative element -->
    <div class="absolute top-0 left-0 right-0 h-96 gradient-header opacity-90 rounded-b-[3rem]"></div>

    <!-- Content -->
    <div class="relative z-10 flex-1 flex flex-col">

        <!-- Header -->
        <header class="pt-12 pb-6 px-6 text-center text-white">
            <div class="text-6xl mb-4 animate-float">🍽️</div>
            <h1 class="text-4xl font-extrabold mb-2 drop-shadow-lg">Fizz & Freeze</h1>
            <p class="text-red-100 text-lg font-medium">Where Every Bite Tells a Story</p>
        </header>

        <!-- Welcome Card -->
        <main class="flex-1 px-4 pb-8">
            <div class="bg-white rounded-3xl shadow-2xl p-6 max-w-md mx-auto mt-4 animate-fade-in">

                <!-- Table Selection -->
                <div id="table-section" class="mb-8">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 text-center mb-2">Welcome!</h2>
                    <p class="text-gray-500 text-center text-sm mb-6">Enter your table number to get started with your order.</p>

                    <!-- Table Number Display -->
                    <div id="table-display" class="hidden mb-6">
                        <div class="bg-gradient-to-r from-primary to-secondary text-white rounded-2xl p-4 text-center">
                            <p class="text-sm opacity-90 mb-1">Your Table</p>
                            <p class="text-4xl font-extrabold" id="table-number-display">--</p>
                        </div>
                        <button onclick="resetTable()" class="w-full mt-3 text-primary text-sm font-medium hover:text-secondary transition-colors">
                            Change Table
                        </button>
                    </div>

                    <div id="table-input-section" class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Enter Table Number</label>
                        <div class="flex gap-3">
                            <input type="number" id="table-input"
                                   class="input-field flex-1"
                                   placeholder="e.g. 12"
                                   min="1" max="99" required>
                            <button type="button" onclick="setPathTable()"
                                    class="bg-primary text-white px-6 py-3 rounded-xl font-semibold hover:bg-secondary transition-colors">
                                Set
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4 text-center">How It Works</h3>

                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-xl flex-shrink-0">📱</div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Browse Menu</h4>
                                <p class="text-sm text-gray-500">Explore our delicious offerings</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-xl flex-shrink-0">🛒</div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Add to Cart</h4>
                                <p class="text-sm text-gray-500">Customize your order easily</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-xl flex-shrink-0">✨</div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Place Order</h4>
                                <p class="text-sm text-gray-500">Food arrives at your table</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('product', ['category' => 'all', 'table' => request('table')]) }}"
                       class="block w-full bg-gradient-to-r from-primary to-secondary text-white text-center font-bold py-4 px-6 rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        View Menu
                        <span class="ml-2">→</span>
                    </a>
                </div>
            </div>

           

        </main>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Auto redirect to menu after 1 second if table number is in URL
        const urlTable = '{{ request()->route("table") }}';
        if (urlTable && urlTable !== '') {
            setTimeout(function() {
                window.location.href = "{{ route('product', ['category' => 'all', 'table' => request()->route('table')]) }}";
            }, 1000);
        }

        const existingTable = CartManager.tableNumber;
        if (existingTable) {
            showTableNumber(existingTable);
        }
    });

    function setPathTable() {
        const input = document.getElementById('table-input');
        const tableNumber = input.value.trim();
        if (tableNumber && tableNumber > 0) {
            window.location.href = `{{ url('/home') }}/${tableNumber}`;
        } else {
            alert('Please enter a valid table number');
        }
    }

    function showTableNumber(tableNumber) {
        document.getElementById('table-display').classList.remove('hidden');
        document.getElementById('table-number-display').textContent = tableNumber;
        document.getElementById('table-input-section').classList.add('hidden');
    }

    function resetTable() {
        CartManager.clearTableNumber();
        document.getElementById('table-display').classList.add('hidden');
        document.getElementById('table-input-section').classList.remove('hidden');
        document.getElementById('table-input').value = '';
    }
</script>
@endpush
