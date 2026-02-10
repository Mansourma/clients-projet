@extends('partials.app')

@section('main')
<style>
    .custom-form-container {
        width: 95%;
        margin: 0 auto;
        padding: 20px;
    }

    .card-header {
        background-color: #000000; /* Black */
        color: #D3AC47; /* Golden */
    }

    .card-body {
        background-color: #F9F9F9; /* Light Gray */
    }

    .card-footer {
        background-color: #F9F9F9; /* Light Gray */
    }

    .btn-primary {
        background-color: #000000; /* Black */
        border-color: #000000; /* Black */
    }

    .btn-primary:hover {
        background-color: #D3AC47; /* Golden */
        border-color: #D3AC47; /* Golden */
    }

    .btn-success {
        background-color: #28a745; /* Success Green */
        border-color: #28a745; /* Success Green */
    }

    .btn-success:hover {
        background-color: #218838; /* Darker Success Green */
        border-color: #1e7e34; /* Darker Success Green */
    }

    .btn-secondary {
        background-color: #6c757d; /* Secondary Gray */
        border-color: #6c757d; /* Secondary Gray */
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .badge.bg-success {
        background-color: #28a745;
        color: #fff;
    }

    .badge.bg-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-black {
        background-color: #000000;
        color: #D3AC47;
        margin-right: 10px;
        border-radius: 8px;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .btn-black:hover {
        background-color: #D3AC47;
        color: #000000;
        border-color: #000000;
    }

    .btn-golden {
        background-color: #D3AC47;
        color: #000000;
        border-radius: 8px;
        margin-right: 10px;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .btn-golden:hover {
        background-color: #000000;
        color: #D3AC47;
        border-color: #D3AC47;
    }
</style>

<div class="custom-form-container my-5">
    <div class="header mb-4 text-center">
        <h1 class="display-3 text-dark font-weight-bold">Service Details</h1>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header text-warning border-0">
            <h2 class="mb-0">{{ $service->service_name }}</h2>
        </div>
        <div class="card-body bg-light text-dark">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Client:</strong>
                        @if($service->client->enterprise_name)
                            {{ $service->client->enterprise_name }}
                        @else
                            {{ $service->client->name_client }}
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Client Code:</strong> {{ $service->client->code_client }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Start Date:</strong> {{ $service->service_start_date ? \Carbon\Carbon::parse($service->service_start_date)->format('d M Y') : 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Payment Type:</strong> {{ ucfirst($service->mode_payment) }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Duration:</strong>
                        {{ $service->is_subscription ? $service->subscription_duration . ' months' : 'N/A' }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Price:</strong> {{ number_format($service->price, 2) }} DH</p>
                </div>
                <div class="col-md-6">
                    <p><strong>TVA:</strong> {{ number_format($service->tva, 2) }}%</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Total Price:</strong> {{ number_format($service->total_price, 2) }} DH</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Due Date:</strong> {{ $service->due_date ? \Carbon\Carbon::parse($service->due_date)->format('d M Y') : 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Last Payment:</strong> {{ $service->dernier_paiement ? \Carbon\Carbon::parse($service->dernier_paiement)->format('d M Y') : 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Created At:</strong> {{ $service->created_at ? $service->created_at->format('d M Y H:i:s') : 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Validation Status:</strong>
                        <span class="badge {{ $service->validation_status == 'validé' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($service->validation_status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Payment Status:</strong>
                        <span class="badge {{ $service->payment_status == 'payé' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($service->payment_status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Service Status:</strong>
                        <span class="badge text-white {{ $service->services_status == 'waiting' ? 'bg-primary' : ($service->services_status == 'to do' ? 'bg-warning' : ($service->services_status == 'in progress' ? 'bg-info' : 'bg-success')) }}">
                            {{ ucfirst($service->services_status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Invoice Number:</strong> {{ $service->invoice_number ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Remaining Subscription:</strong> {{ $service->remains_subscription ?? 'N/A' }} months</p>
                </div>
                <div class="col-md-12">
                    <p><strong>Description:</strong> {{ $service->service_description ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light text-center">
            @if($service->services_status === 'a faire')
                <a href="{{ route('client.downloadOrder', ['id' => $service->client_id]) }}" class="btn btn-black me-2">
                    <i class="fas fa-download"></i> Download Order
                </a>
            @elseif($service->services_status === 'fini')
                <a href="{{ route('download.invoice', $service->id) }}" class="btn btn-golden me-2">
                    <i class="fas fa-file-invoice"></i> Download Invoice
                </a>
                <a href="{{ route('services_archive.client', $service->client_id) }}" class="btn btn-black me-2">
                    <i class="fas fa-list"></i> Client Service Archive
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
