@extends('layouts/layoutMaster')

@section('title', 'Print All QR Codes')

@section('page-style')
<style>
    @media print {
        .no-print { display: none !important; }
        .qr-card { page-break-inside: avoid; }
    }
    .qr-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
    .qr-card {
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
    }
    .qr-card img {
        max-width: 180px;
        margin: 10px auto;
    }
    .table-number {
        font-size: 2rem;
        font-weight: bold;
        color: #440012;
    }
</style>
@endsection

@section('content')
    <div class="card mb-4 no-print">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Print All QR Codes</h4>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="ti ti-printer me-1"></i> Print All
                </button>
                <a href="{{ route('app-tables-list') }}" class="btn btn-secondary" >
                    <i class="ti ti-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <p class="text-muted">Below are QR codes for all active tables. Click "Print All" to print them for placing on tables.</p>
        </div>
    </div>

    <div class="qr-grid">
        @forelse($qrCodes as $item)
            <div class="qr-card">
                <h5>🍽️ Fizz & Freeze</h5>
                <img src="{{ $item['qr'] }}" alt="QR Code">
                <div class="table-number">Table {{ $item['table']->table_number }}</div>
                @if($item['table']->name)
                    <p class="text-muted mb-0">{{ $item['table']->name }}</p>
                @endif
                <small class="text-muted">Scan to order</small>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No active tables found. Please add tables first.</p>
                <a href="{{ route('app-tables-add') }}" class="btn btn-primary">Add Table</a>
            </div>
        @endforelse
    </div>
@endsection
