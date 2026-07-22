<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#57131b">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Fizz & Freeze')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/fizzfavicon.svg') }}" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#681f32ff',
                        secondary: '#5d192b',
                        accent: '#6f3242',
                    }
                }
            }
        }
    </script>

    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('css/theme-styles.css') }}">

    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>

    <!-- SweetAlert2 with fallback -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fallback if SweetAlert2 CDN fails to load
        if (typeof Swal === 'undefined') {
            window.Swal = {
                fire: function(options) {
                    return new Promise((resolve) => {
                        if (options.showCancelButton) {
                            if (confirm(options.title + '\n\n' + (options.text || ''))) {
                                resolve({ isConfirmed: true });
                            } else {
                                resolve({ isConfirmed: false });
                            }
                        } else {
                            alert(options.title + (options.text ? '\n\n' + options.text : ''));
                            resolve({ isConfirmed: true });
                        }
                    });
                }
            };
        }
    </script>

    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">

    @yield('content')

    <!-- Bottom Navigation -->
    @include('frontend.partials.bottom-nav')

    <!-- Theme Scripts -->
    <script>
        // Cart Manager for localStorage (cart) and sessionStorage (table)
        const CartManager = {
            STORAGE_KEY: 'savory_bites_cart',
            TABLE_KEY: 'table_number', // Using sessionStorage for table

            get cart() {
                return JSON.parse(localStorage.getItem(this.STORAGE_KEY) || '[]');
            },

            set cart(items) {
                localStorage.setItem(this.STORAGE_KEY, JSON.stringify(items));
                this.updateBadges();
            },

            get tableNumber() {
                return sessionStorage.getItem(this.TABLE_KEY);
            },

            setTableNumber(num) {
                sessionStorage.setItem(this.TABLE_KEY, num);
                this.updateTableIndicators();
            },

            clearTableNumber() {
                sessionStorage.removeItem(this.TABLE_KEY);
                this.updateTableIndicators();
            },

            updateTableIndicators() {
                const tableNum = this.tableNumber;
                document.querySelectorAll('.table-indicator').forEach(indicator => {
                    indicator.textContent = tableNum ? `Table: ${tableNum}` : 'No table set';
                });
            },

            addItem(product, quantity = 1) {
                const cart = this.cart;
                const existingIndex = cart.findIndex(item => item.id === product.id);
                
                if (existingIndex > -1) {
                    cart[existingIndex].quantity += quantity;
                } else {
                    cart.push({
                        ...product,
                        quantity: quantity,
                        cartId: Date.now()
                    });
                }
                
                this.cart = cart;
                this.showToast(`${product.name} added to cart!`);
            },

            updateQuantity(cartId, quantity) {
                let cart = this.cart;
                if (quantity <= 0) {
                    cart = cart.filter(item => item.cartId !== cartId);
                } else {
                    const item = cart.find(item => item.cartId === cartId);
                    if (item) item.quantity = quantity;
                }
                this.cart = cart;
            },

            findItemByProductId(productId) {
                return this.cart.find(item => item.id == productId);
            },

            removeItem(cartId) {
                this.cart = this.cart.filter(item => item.cartId !== cartId);
            },

            clearCart() {
                this.cart = [];
            },

            getItemCount() {
                return this.cart.reduce((sum, item) => sum + item.quantity, 0);
            },

            getCart() {
                return this.cart;
            },

            getSubtotal() {
                return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            },

            getTax() {
                return 0; // No tax
            },

            getTotal() {
                return this.getSubtotal(); // Total = Subtotal (no tax)
            },

            updateBadges() {
                const count = this.getItemCount();
                document.querySelectorAll('.cart-badge').forEach(badge => {
                    if (count > 0) {
                        badge.style.display = 'flex';
                        badge.textContent = count > 99 ? '99+' : count;
                    } else {
                        badge.style.display = 'none';
                    }
                });
            },

            showToast(message) {
                // Remove existing toasts
                document.querySelectorAll('.toast-notification').forEach(t => t.remove());
                
                const toast = document.createElement('div');
                toast.className = 'toast-notification fixed top-4 left-1/2 -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-full shadow-lg z-50 animate-slide-down';
                toast.innerHTML = `<span class="mr-2">✓</span>${message}`;
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.classList.add('animate-slide-up');
                    setTimeout(() => toast.remove(), 300);
                }, 2000);
            }
        };

        // Initialize cart badges and table indicators on load
        document.addEventListener('DOMContentLoaded', () => {
            // Check for table number from URL path (e.g., /home/5)
            const pathSegments = window.location.pathname.split('/');
            const homeIndex = pathSegments.indexOf('home');
            
            if (homeIndex !== -1 && pathSegments[homeIndex + 1]) {
                const tableFromPath = pathSegments[homeIndex + 1];
                if (!isNaN(tableFromPath) && tableFromPath > 0) {
                    CartManager.setTableNumber(tableFromPath);
                }
            }

            CartManager.updateBadges();
            CartManager.updateTableIndicators();
        });
    </script>

    @stack('scripts')
</body>
</html>
