@extends('layouts/layoutMaster')

@section('title', 'Order Details - ' . $order->order_number)

@section('content')
    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">Order #{{ $order->order_number }}</h4>
                        <small class="text-muted">{{ $order->created_at->format('d M Y, h:i A') }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        @if($order->status === 'completed')
                        <a href="{{ route('app-orders-print', encrypt($order->id)) }}" class="btn btn-outline-secondary" target="_blank">
                            <i class="ti ti-printer me-1"></i> Print
                        </a>
                        @endif
                        <a href="{{ route('app-orders-list') }}" class="btn btn-secondary" style="background-color: #4C0014">
                            <i class="ti ti-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Order Status -->
                    <div class="mb-4">
                        <h6 class="mb-3">Order Status</h6>
                        <div class="d-flex gap-2 flex-wrap">
                            @php
                                $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
                            @endphp
                            @foreach($statuses as $status)
                                @php
                                    $isActive = $order->status === $status;
                                    if ($status === 'confirmed' && in_array($order->status, ['preparing', 'ready', 'served'])) {
                                        $isActive = true;
                                    }
                                @endphp
                                <button class="btn btn-sm {{ $isActive ? 'btn-primary' : 'btn-outline-secondary' }}" 
                                        onclick="updateStatus('{{ $status }}')"
                                        {{ $order->status === 'cancelled' || $order->status === 'completed' ? 'disabled' : '' }}>
                                    {{ ucfirst($status) }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    @if($item->status !== 'cancelled')
                                    <tr>
                                        <td>
                                            <strong>{{ $item->product_name }}</strong>
                                            @if($item->special_instructions)
                                                <br><small class="text-muted">{{ $item->special_instructions }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                                        <td class="text-end">₹{{ number_format($item->total, 2) }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="3" class="text-end">Subtotal</th>
                                    <th class="text-end">₹{{ number_format($order->subtotal, 2) }}</th>
                                </tr>
                                @if($order->tax > 0)
                                <tr>
                                    <th colspan="3" class="text-end">Tax</th>
                                    <th class="text-end">₹{{ number_format($order->tax, 2) }}</th>
                                </tr>
                                @endif
                                @if($order->discount > 0)
                                <tr>
                                    <th colspan="3" class="text-end">Discount</th>
                                    <th class="text-end text-danger">-₹{{ number_format($order->discount, 2) }}</th>
                                </tr>
                                @endif
                                <tr class="table-primary">
                                    <th colspan="3" class="text-end">Total</th>
                                    <th class="text-end">₹{{ number_format($order->total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($order->notes)
                        <div class="alert alert-warning mt-3">
                            <strong>Notes:</strong> {{ $order->notes }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Customer Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Customer Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Name</label>
                        <p class="mb-0 fw-semibold">{{ $order->customer_name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Mobile</label>
                        <p class="mb-0">
                            <a href="tel:{{ $order->customer_mobile }}">{{ $order->customer_mobile }}</a>
                        </p>
                    </div>
                    <div>
                        <label class="text-muted small">Table Number</label>
                        <p class="mb-0 fs-4 fw-bold text-primary">{{ $order->table_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Payment Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Status</label>
                        <p class="mb-0">
                            <span class="badge bg-label-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }} fs-6">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                    </div>
                    @if($order->payment_method)
                    <div class="mb-3">
                        <label class="text-muted small">Method</label>
                        <p class="mb-0">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="text-muted small">Total Amount</label>
                        <p class="mb-0 fs-4 fw-bold text-success">₹{{ number_format($order->total, 2) }}</p>
                    </div>

                    @if($order->payment_status === 'unpaid')
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select" id="payment-method">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="upi">UPI</option>
                            </select>
                        </div>
                        <button class="btn btn-success w-100" onclick="handlePayment()">
                            <i class="ti ti-check me-1"></i> Make Payment
                        </button>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order Timeline</h5>
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <span class="timeline-indicator timeline-indicator-success"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Order Placed</h6>
                                    <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        </li>
                        @if($order->confirmed_at)
                        <li class="timeline-item">
                            <span class="timeline-indicator timeline-indicator-info"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Confirmed</h6>
                                    <small class="text-muted">{{ $order->confirmed_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        </li>
                        @endif

                        @if($order->prepared_at)
                        <li class="timeline-item">
                            <span class="timeline-indicator timeline-indicator-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Preparing Completed</h6>
                                    <small class="text-muted">{{ $order->prepared_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        </li>
                        @endif

                        @if($order->served_at)
                        <li class="timeline-item">
                            <span class="timeline-indicator timeline-indicator-success"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Served</h6>
                                    <small class="text-muted">{{ $order->served_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        </li>
                        @endif

                        @if($order->completed_at)
                        <li class="timeline-item">
                            <span class="timeline-indicator timeline-indicator-dark"></span>
                            <div class="timeline-event">
                                <div class="timeline-header">
                                    <h6 class="mb-0">Completed</h6>
                                    <small class="text-muted">{{ $order->completed_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script>
    function updateStatus(status) {
        if (!confirm('Update order status to ' + status + '?')) return;
        
        $.ajax({
            url: "{{ route('app-orders-update-status', encrypt($order->id)) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then(() => location.reload());
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong'
                });
            }
        });
    }

    function handlePayment() {
        const method = document.getElementById('payment-method').value;
        
        if (method === 'upi') {
            showUpiQrCode();
        } else {
            markAsPaid(method);
        }
    }

    function markAsPaid(method = null) {
        if (!method) {
            method = document.getElementById('payment-method').value;
        }
        
        $.ajax({
            url: "{{ route('app-orders-update-payment', encrypt($order->id)) }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                payment_status: 'paid',
                payment_method: method
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    }).then(() => {
                        window.open("{{ route('app-orders-print', encrypt($order->id)) }}", '_blank');
                        location.reload();
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Something went wrong'
                });
            }
        });
    }

    function showUpiQrCode() {
        // Show loading
        Swal.fire({
            title: 'Generating QR Code...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: "{{ route('app-orders-generate-upi-qr', encrypt($order->id)) }}",
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    displayUpiQrModal(response.data);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || 'Failed to generate QR code'
                });
            }
        });
    }

    function displayUpiQrModal(data) {
        Swal.fire({
            title: '<strong>UPI Payment</strong>',
            html: `
                <div class="text-center">
                    <img src="${data.qr_code}" alt="UPI QR Code" class="img-fluid mb-3" style="max-width: 300px; border: 2px solid #ddd; border-radius: 10px; padding: 10px;">
                    <div class="alert alert-info text-start">
                        <p class="mb-2"><strong>Amount:</strong> ₹${parseFloat(data.amount).toFixed(2)}</p>
                        <p class="mb-2"><strong>Order:</strong> #${data.order_number}</p>
                        <p class="mb-2"><strong>UPI ID:</strong> ${data.upi_id}</p>
                        <p class="mb-0"><strong>Merchant:</strong> ${data.merchant_name}</p>
                    </div>
                    <p class="text-muted small">Scan this QR code with any UPI app to make payment</p>
                </div>
            `,
            width: 600,
            showCancelButton: true,
            confirmButtonText: '<i class="ti ti-check me-1"></i> Payment Completed',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            customClass: {
                confirmButton: 'btn btn-success me-2',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                markAsPaid('upi');
            }
        });
    }
</script>
@endsection
