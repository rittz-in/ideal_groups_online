@extends('layouts/layoutMaster')

@section('title', 'QR Code - Table ' . $table->table_number)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">QR Code for Table {{ $table->table_number }}</h4>
                    <a href="{{ route('app-tables-list') }}" class="btn btn-secondary" style="background-color: #440012;">
                        <i class="ti ti-arrow-left me-1"></i> Back
                    </a>
                </div>
                <div class="card-body text-center">
                    <!-- QR Code Display -->
                    <div class="bg-white p-4 rounded-3 shadow-sm d-inline-block mb-4">
                        <img src="{{ $qrCode }}" alt="QR Code for Table {{ $table->table_number }}" style="max-width: 300px;">
                    </div>

                    <!-- Table Info -->
                    <div class="mb-4">
                        <h2 class="text-primary mb-2">Table {{ $table->table_number }}</h2>
                        @if($table->name)
                            <p class="text-muted">{{ $table->name }}</p>
                        @endif
                    </div>

                    <!-- URL Info -->
                    <div class="alert alert-info text-start">
                        <strong>Scan URL:</strong>
                        <br>
                        <a href="{{ $qrUrl }}" target="_blank">{{ $qrUrl }}</a>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('app-tables-qr-download', encrypt($table->id)) }}" class="btn btn-primary">
                            <i class="ti ti-download me-1"></i> Download PNG
                        </a>
                        <button onclick="printQR()" class="btn btn-success">
                            <i class="ti ti-printer me-1"></i> Print
                        </button>
                    </div>
                </div>
            </div>

            <!-- Instructions Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">📋 Instructions</h5>
                </div>
                <div class="card-body">
                    <ol class="mb-0">
                        <li class="mb-2">Download or print this QR code</li>
                        <li class="mb-2">Place it on Table {{ $table->table_number }}</li>
                        <li class="mb-2">Customers scan the code with their phone camera</li>
                        <li class="mb-2">They'll be directed to the menu page with table info pre-filled</li>
                        <li class="mb-0">Orders will automatically include the table number</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Template (Hidden) -->
    <div id="print-template" class="d-none">
        <div style="text-align: center; padding: 40px; font-family: Arial, sans-serif;">
            <h1 style="margin-bottom: 20px;">🍽️ Fizz & Freeze</h1>
            <img src="{{ $qrCode }}" style="width: 250px; height: 250px; margin-bottom: 20px;">
            <h2 style="color: #e94560;">Table {{ $table->table_number }}</h2>
            <p style="color: #666;">Scan to view menu & order</p>
        </div>
    </div>
@endsection

@section('page-script')
<script>
    function printQR() {
        const printContent = document.getElementById('print-template').innerHTML;
        const printWindow = window.open('', '', 'width=400,height=600');
        printWindow.document.write(`
            <html>
            <head><title>Table {{ $table->table_number }} QR Code</title></head>
            <body>${printContent}</body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
</script>
@endsection
