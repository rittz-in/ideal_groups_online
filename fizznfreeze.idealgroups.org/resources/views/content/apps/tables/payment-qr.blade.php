@extends('layouts/layoutMaster')

@section('title', 'QR Code for Payment')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Tables /</span> QR Code for Payment
</h4>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header bg-primary text-white">Generate Dynamic UPI QR</h5>
            <div class="card-body">
                <p class="text-muted mb-4">Generate a UPI QR code instantly with or without a specific amount for flexible payments.</p>
                
                <div class="mb-3">
                    <label for="dynamic_amount" class="form-label">Amount (Optional)</label>
                    <div class="input-group">
                        <span class="input-group-text">₹</span>
                        <input class="form-control" type="number" id="dynamic_amount" placeholder="Enter amount or leave empty" step="0.01" min="0">
                    </div>
                    <div class="form-text">💡 Leave empty to generate a QR code where customers can enter any amount</div>
                </div>
                
                <button type="button" class="btn btn-primary w-100" onclick="generateDynamicQr()">
                    <i class="ti ti-qrcode me-1"></i> Generate QR Code
                </button>
            </div>
        </div>

        <div class="card mb-4" id="generated-qr-card" style="display: none;">
            <h5 class="card-header">Generated QR Code</h5>
            <div class="card-body text-center">
                <img id="generated-qr-image" src="" alt="Generated QR Code" class="img-fluid mb-3" style="max-width: 300px; border: 2px solid #ddd; border-radius: 10px; padding: 10px;">
                <div class="alert alert-info text-start" id="generated-qr-details">
                </div>
                <button type="button" class="btn btn-outline-primary" onclick="downloadQrCode()">
                    <i class="ti ti-download me-1"></i> Download QR Code
                </button>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header">Current Static QR Code</h5>
            <div class="card-body text-center">
                @if($qrPath)
                    <div class="mb-3 animate__animated animate__fadeIn">
                        <img src="{{ asset($qrPath) }}" alt="Payment QR Code" class="img-fluid rounded shadow-sm border" style="max-height: 300px;">
                    </div>
                    <div class="mb-4 text-start">
                        <p class="mb-1"><strong>UPI ID:</strong> {{ \App\Models\PaymentSetting::getVal('payment_upi_id', 'Not Set') }}</p>
                        <p class="mb-0"><strong>Merchant Name:</strong> {{ \App\Models\PaymentSetting::getVal('payment_merchant_name', 'Not Set') }}</p>
                    </div>
                    <form action="{{ route('app-tables-payment-qr-delete') }}" method="POST" id="delete-qr-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-label-danger w-100" onclick="confirmDelete()">
                            <i class="ti ti-trash me-1"></i> Delete Static QR
                        </button>
                    </form>
                @else
                    <div class="p-5 border border-dashed rounded text-muted">
                        <i class="ti ti-qrcode ti-lg mb-2"></i>
                        <p class="mb-0">No static QR code uploaded.<br><small>Upload a custom QR image below or use dynamic generation</small></p>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mb-4">
            <h5 class="card-header">Upload Custom Static QR Code</h5>
            <div class="card-body">
                <form action="{{ route('app-tables-payment-qr-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="upi_id" class="form-label">UPI ID (VPA) <span class="text-danger">*</span></label>
                        <input class="form-control @error('upi_id') is-invalid @enderror" type="text" id="upi_id" name="upi_id" placeholder="e.g. yourname@okaxis" value="{{ \App\Models\PaymentSetting::getVal('payment_upi_id') }}" required>
                        @error('upi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="merchant_name" class="form-label">Merchant Name <span class="text-danger">*</span></label>
                        <input class="form-control @error('merchant_name') is-invalid @enderror" type="text" id="merchant_name" name="merchant_name" placeholder="e.g. Fizz & Freeze Cafe" value="{{ \App\Models\PaymentSetting::getVal('payment_merchant_name') }}" required>
                        @error('merchant_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="qr_code" class="form-label">Upload Custom QR Image (Optional)</label>
                        <input class="form-control @error('qr_code') is-invalid @enderror" type="file" id="qr_code" name="qr_code" accept="image/*">
                        @error('qr_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Allowed: JPG, PNG, SVG. Max size: 2MB.</div>
                    </div>
                    
                    <div id="preview-container" class="mb-3 d-none">
                        <p class="text-sm fw-medium mb-2">Image Preview:</p>
                        <img id="qr-preview" src="#" alt="Preview" class="img-fluid rounded border" style="max-height: 200px;">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="ti ti-upload me-1"></i> Save Settings
                    </button>
                </form>
            </div>
        </div>
    </div>


<script>
document.getElementById('qr_code').onchange = evt => {
    const [file] = document.getElementById('qr_code').files;
    if (file) {
        document.getElementById('preview-container').classList.remove('d-none');
        document.getElementById('qr-preview').src = URL.createObjectURL(file);
    }
}

function confirmDelete() {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete the current payment QR code!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            confirmButton: 'btn btn-primary me-1',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-qr-form').submit();
        }
    });
}

function generateDynamicQr() {
    const amount = document.getElementById('dynamic_amount').value;
    
    // Show loading
    Swal.fire({
        title: 'Generating QR Code...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: "{{ route('app-tables-generate-payment-qr') }}",
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            amount: amount || null
        },
        success: function(response) {
            Swal.close();
            if (response.success) {
                displayGeneratedQr(response.data);
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

function displayGeneratedQr(data) {
    const qrCard = document.getElementById('generated-qr-card');
    const qrImage = document.getElementById('generated-qr-image');
    const qrDetails = document.getElementById('generated-qr-details');
    
    qrImage.src = data.qr_code;
    
    let detailsHtml = `
        <p class="mb-2"><strong>UPI ID:</strong> ${data.upi_id}</p>
        <p class="mb-2"><strong>Merchant:</strong> ${data.merchant_name}</p>
    `;
    
    if (data.amount && data.amount > 0) {
        detailsHtml += `<p class="mb-0"><strong>Amount:</strong> ₹${parseFloat(data.amount).toFixed(2)}</p>`;
    } else {
        detailsHtml += `<p class="mb-0"><strong>Amount:</strong> <span class="text-muted">Not Fixed (Customer can enter)</span></p>`;
    }
    
    qrDetails.innerHTML = detailsHtml;
    qrCard.style.display = 'block';
    
    // Scroll to the generated QR
    qrCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

function downloadQrCode() {
    const qrImage = document.getElementById('generated-qr-image');
    const link = document.createElement('a');
    link.href = qrImage.src;
    link.download = 'upi-payment-qr-' + Date.now() + '.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
@endsection
