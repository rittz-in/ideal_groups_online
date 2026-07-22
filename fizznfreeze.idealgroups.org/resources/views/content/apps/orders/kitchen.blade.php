@extends('layouts/layoutMaster')

@section('title', 'Kitchen Display')

@section('page-style')
<style>
    body { 
        background-color: #f8f9fa;
    }
    .kitchen-header {
        background: linear-gradient(135deg, #440012 0%, #6b0020 100%);
        padding: 20px;
        color: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(68, 0, 18, 0.3);
    }
    .order-card {
        background: #dadada;
        border-radius: 12px;
        padding: 20px;
        color: #333;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
         
    }
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(68, 0, 18, 0.15);
        
    }
    .order-card.pending { border-left: 5px solid #ffc107; }
    .order-card.confirmed { border-left: 5px solid #17a2b8; }
    .order-card.preparing { border-left: 5px solid #440012; }
    .order-card.ready { border-left: 5px solid #28a745; }
    .order-card.served { border-left: 5px solid #9b59b6; background: #f5f0f7; }
    .order-card.completed { border-left: 5px solid #6c757d; animation: pulse 2s infinite; }
    .order-card.cancelled { border-left: 5px solid #dc3545; }
    
    @keyframes pulse {
        0%, 100% { box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        50% { box-shadow: 0 0 20px 10px rgba(40, 167, 69, 0.2); }
    }
    
    .order-number {
        font-size: 1.5rem;
        font-weight: bold;
        color: #440012;
    }
    .table-badge {
        background: #440012;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: bold;
        display: inline-block;
        color: white;
    }
    .item-list {
        background: #fcf5f5ff;
        border-radius: 8px;
        padding: 12px;
        margin-top: 15px;
        border: 1px solid #eee;
    }
    .item-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
    }
    .item-row:last-child { border-bottom: none; }
    .item-qty {
        background: #440012;
        color: white;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 10px;
    }
    .time-elapsed {
        font-size: 0.8rem;
        color: #666;
    }
    .time-warning { color: #f39c12 !important; }
    .time-danger { color: #dc3545 !important; }
    .action-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: all 0.2s;
    }
    .action-btn:hover {
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(52, 52, 52, 0.2);
    }
    .btn-confirm { background: #17a2b8; color: white; width: 100%; }
    .btn-preparing { background: #440012; color: white; width: 100%; }
    .btn-ready { background: #28a745; color: white; width: 100%; }
    .btn-served { background: #6c757d; color: white; width: 100%; }
    
    #no-orders {
        color: #666 !important;
    }
    #no-orders h3, #no-orders p {
        color: #666 !important;
    }
</style>
@endsection

@section('content')
    <div class="kitchen-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-0" style="color: white;">Kitchen Display</h3>
                <small>Active orders - Auto refreshes every 10 seconds</small>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span id="current-time" class="fs-4"></span>
                <a href="{{ route('app-orders-list') }}" class="btn btn-light">
                    <i class="ti ti-list me-1"></i> All Orders
                </a>
            </div>
        </div>
    </div>

    <div class="row" id="orders-container">
        <!-- Orders will be loaded here -->
    </div>

    <div id="no-orders" class="text-center py-5 d-none">
        <i class="ti ti-mood-happy fs-1 mb-3" style="color: #440012;"></i>
        <h3>No Active Orders</h3>
        <p class="opacity-75">All caught up! Waiting for new orders...</p>
    </div>
@endsection

@section('page-script')
<script>
    function loadOrders() {
        $.get("{{ route('app-orders-active') }}", function(orders) {
            const container = $('#orders-container');
            const noOrders = $('#no-orders');
            
            if (orders.length === 0) {
                container.html('');
                noOrders.removeClass('d-none');
                return;
            }
            
            noOrders.addClass('d-none');
            
            let html = '';
            orders.forEach(order => {
                const timeClass = order.time_elapsed > 20 ? 'time-danger' : (order.time_elapsed > 10 ? 'time-warning' : '');
                
                let actionBtn = '';
                switch(order.status) {
                    case 'pending':
                        actionBtn = `<button class="action-btn btn-confirm" onclick="updateOrderStatus('${order.encrypted_id}', 'confirmed')">Confirm</button>`;
                        break;
                    case 'confirmed':
                        actionBtn = `<button class="action-btn btn-preparing" onclick="updateOrderStatus('${order.encrypted_id}', 'preparing')">Start Preparing</button>`;
                        break;
                    case 'preparing':
                        actionBtn = `<button class="action-btn btn-ready" onclick="updateOrderStatus('${order.encrypted_id}', 'ready')">Mark Ready</button>`;
                        break;
                    case 'ready':
                        actionBtn = `<button class="action-btn btn-served" onclick="updateOrderStatus('${order.encrypted_id}', 'served')">Mark Served</button>`;
                        break;
                    case 'served':
                        actionBtn = `<span class="badge bg-secondary w-100 py-2">Served - Complete from Orders View</span>`;
                        break;
                }
                
                let itemsHtml = order.items.map(item => `
                    <div class="item-row">
                        <div class="d-flex align-items-center flex-grow-1">
                            <span class="item-qty">${item.quantity}</span>
                            <span>${item.name}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            ${item.instructions ? `<small class="text-warning me-2">${item.instructions}</small>` : ''}
                            <button class="btn btn-sm p-0 border-0" onclick="cancelOrderItem('${item.encrypted_id}')" title="Cancel Item">
                                <i class="ti ti-trash text-danger" style="font-size: 1.2rem;"></i>
                            </button>
                        </div>
                    </div>
                `).join('');
                
                html += `
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="order-card ${order.status}">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <span class="order-number">#${order.display_number}</span>
                                    <span class="time-elapsed ${timeClass}">${order.created_at}</span>
                                </div>
                                <span class="table-badge">T${order.table_number}</span>
                            </div>
                            
                            <div class="mb-2">
                                <small class=""style="color: #440012; font-weight: bold;" >Customer: ${order.customer_name}</small>
                            </div>
                            
                            <div class="item-list">
                                ${itemsHtml}
                            </div>
                            
                            <div class="mt-3 text-center">
                                ${actionBtn}
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.html(html);
        });
    }

    function cancelOrderItem(encryptedId) {
        if (!confirm('Are you sure you want to remove this item from the order?')) return;
        
        $.ajax({
            url: "{{ url('app/orders/cancel-item') }}/" + encryptedId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    loadOrders();
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON?.message || 'Failed to remove item');
            }
        });
    }

    function updateOrderStatus(encryptedId, status) {
        $.ajax({
            url: "{{ url('app/orders/update-status') }}/" + encryptedId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if (response.success) {
                    loadOrders();
                }
            }
        });
    }

    function updateTime() {
        const now = new Date();
        $('#current-time').text(now.toLocaleTimeString());
    }

    $(document).ready(function() {
        loadOrders();
        updateTime();
        
        // Auto-refresh every 10 seconds
        setInterval(loadOrders, 10000);
        setInterval(updateTime, 1000);
    });
</script>
@endsection
