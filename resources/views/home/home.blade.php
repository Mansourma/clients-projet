@extends('partials.app')
@section('title', 'Home')
@section('main')
<style>
.container-fluid {
    margin-top: 100px;
    font-size: 50px;
    max-width: 2550px;
    margin-left: 600px;
    margin-right: -2000px;
}
.welcome-message h1 {
    font-size: 2.5rem;
}
.welcome-message p {
    font-size: 1.25rem;
}
.card {
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}
.card-body {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.card-title {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}
.card-text {
    font-size: 1.25rem;
}
.card-footer {
    text-align: center;
}
.btn {
    border-radius: 10px;
}
.dropdown-menu {
    border: 1px solid #D3AC47;
}
.btn-outline-black {
    color: #000000;
}
.btn-outline-black:hover {
    background-color: #000000;
    color: #D3AC47;
}
</style>
<div class="container-fluid main-container" style="width: 100%; margin-left: -1px;">
    <div class="row mb-4" style="margin-top: -90px">
        <div class="col-md-8 d-flex align-items-center">
            <div class="welcome-message">
                @php
                    $currentHour = date('H');
                    $greeting = ($currentHour < 12) ? 'Good Morning' : 'Good Evening';
                @endphp
                <h1 class="text-black font-weight-bold">{{ $greeting }}, {{ Auth::user()->name }}</h1>
                <p class="text-black">Are you ready to explore client statistics?</p>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card" style="background-color: #000; Border-radius: 20px">
                <div class="card-body">
                    <div>
                        <h5 class="card-title" style="color: #D3AC47; ">Total Clients </h5>
                        <p class="card-text" style="color: #D3AC47;">{{ $totalClients }}</p>
                    </div>
                    <i class="fas fa-users" style="color: #D3AC47; font-size: 2rem;"></i>
                </div>
                <div class="card-footer">
                    <a href="{{ route('clients.index') }}" class="btn" style="color: #000; background-color: #D3AC47;">View Clients</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="background-color: #D3AC47; ">
                <div class="card-body">
                    <div>
                        <h5 class="card-title" style="color: #000;">Subscribed Services</h5>
                        <p class="card-text" style="color: #000;">{{ $totalSubscribedClients }}</p>
                    </div>
                    <i class="fas fa-check-circle" style="color: #000; font-size: 2rem;"></i>
                </div>
                <div class="card-footer">
                    <a href="{{ route('services.index', ['is_subscription' => '1']) }}" class="btn" style="color: #D3AC47; background-color: #000;">View Subscribed</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="background-color: #000; ">
                <div class="card-body">
                    <div>
                        <h5 class="card-title" style="color: #D3AC47;">Total Services</h5>
                        <p class="card-text" style="color: #D3AC47;">{{ $totalServices }}</p>
                    </div>
                    <i class="fas fa-clipboard-list" style="color: #D3AC47; font-size: 2rem;"></i>
                </div>
                <div class="card-footer">
                    <a href="{{ route('services.index') }}" class="btn" style="color: #000; background-color: #D3AC47;">View Services</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="background-color: #D3AC47;">
                <div class="card-body">
                    <div>
                        <h5 class="card-title" style="color: #000;">Enterprises</h5>
                        <p class="card-text" style="color: #000;">{{ $totalEnterpriseClients }}</p>
                    </div>
                    <i class="fas fa-building" style="color: #000; font-size: 2rem;"></i>
                </div>
                <div class="card-footer">
                    <a href="{{ route('clients.index', ['type' => 'society']) }}" class="btn" style="color: #D3AC47; background-color: #000;">View Enterprises</a>
                </div>
            </div>
        </div>
    </div>
</div>
<h3 class="mb-4">Latest Services</h3>
<table class="table table-striped table-bordered table-warning">
    <thead>
        <tr style="background:#D3AC47;">
            <th>Service Name</th>
            <th>Client</th>
            <th>Price</th>
            <th>Total Price</th>
            <th>Payment Status</th>
            <th>Validation Status</th>
            <th>Service Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="services-table-body">
    @foreach($services as $service)
        <tr id="service-row-{{ $service->id }}">
            <td>{{ $service->service_name }}</td>
            <td>
@if($service->client)
    {{ $service->client->enterprise_name ?? $service->client->name_client }}
    @if(isset($service->client->prenom_client))
        {{ $service->client->prenom_client }}
    @endif
@endif
</td>
<td>{{ $service->price }} MAD</td>
<td>{{ $service->total_price }} MAD</td>
<td>
<form method="POST" action="{{ route('services.updatePaymentStatus', $service->id) }}" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-sm
        @if($service->payment_status == 'payé')
            btn-success
        @elseif($service->payment_status == 'subscription end')
            btn-secondary
        @else
            btn-danger
        @endif">
        @if($service->payment_status == 'payé')
            Paid
        @elseif($service->payment_status == 'subscription end')
            Subscription Ended
        @else
            Not Paid
        @endif
    </button>
    <input type="hidden" name="status" value="{{ $service->payment_status == 'payé' ? 'non payé' : 'payé' }}">
</form>
</td>
@if(Auth::user()->isAdmin())
<td>
<button class="btn btn-sm
    @if($service->validation_status == 'validé') btn-success
    @elseif($service->validation_status == 'en cours') btn-warning
    @else btn-danger
    @endif"
    disabled>
    {{ $service->validation_status == 'validé' ? 'Validated' : ($service->validation_status == 'en cours' ? 'In Progress' : 'Not Validated') }}
</button>
</td>
@elseif(Auth::user()->isSuperAdmin())
<td>
<form method="POST" action="{{ route('services.updateValidationStatus', $service->id) }}" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-sm
        @if($service->validation_status == 'validé') btn-success
        @elseif($service->validation_status == 'en cours') btn-warning
        @else btn-danger
        @endif">
        {{ $service->validation_status == 'validé' ? 'Validated' : ($service->validation_status == 'en cours' ? 'In Progress' : 'Not Validated') }}
    </button>
    <input type="hidden" name="status" value="{{ $service->validation_status == 'validé' ? 'non-validé' : 'validé' }}">
</form>
</td>
@endif
<td>
    <select class="form-control service-status-select" data-service-id="{{ $service->id }}"
        @if(Auth::user()->isAdmin()) disabled @endif>
        <option value="in progress" {{ $service->services_status == 'in progress' ? 'selected' : '' }}>In Progress</option>
        <option value="to do" {{ $service->services_status == 'to do' ? 'selected' : '' }}>To Do</option>
        <option value="done" {{ $service->services_status == 'done' ? 'selected' : '' }}>Done</option>
        <option value="waiting" {{ $service->services_status == 'waiting' ? 'selected' : '' }}>Waiting</option>
    </select>
</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-outline-black dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('services.show', $service->id) }}">
                                <i class="fas fa-eye me-2"></i> View
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a href="{{ route('services.editcustom', $service->id) }}" class="d-block text-decoration-none">
                                <i class="fas fa-edit me-2"></i> Edit
                            </a>
                        </li>
                        @if(!Auth::user()->isAdmin())
                        <li>
                            <form id="delete-form-{{ $service->id }}" action="{{ route('services.destroy', $service->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                               <button type="button" class="dropdown-item delete-btn text-danger" data-form-id="{{ $service->id }}">
                                <i class="fas fa-trash me-2"></i> Delete
                               </button>
                               </form>
                        </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('services_archive.client', $service->client_id) }}">
                                <i class="fas fa-archive me-2"></i> View Archives
                            </a>
                        </li>
                        @if(($service->services_status === 'to do' || $service->services_status === 'done') && $service->is_subscription === 0)
                        <li>
                            <a class="dropdown-item" href="{{ route('download.invoice', $service->id) }}">
                                <i class="fas fa-file-invoice me-2"></i> Download Invoice
                            </a>
                        </li>
                        @endif
                        @if($service->payment_status === 'payé' && $service->validation_status === 'validé')
                        <li>
                            <a class="dropdown-item" href="{{ route('download.invoice', $service->id) }}">
                                <i class="fas fa-file-invoice me-2"></i> Download Invoice
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.querySelectorAll('.service-status-select').forEach(select => {
        select.addEventListener('change', function() {
            const serviceId = this.dataset.serviceId;
            const newStatus = this.value;
            $.ajax({
                url: `/services/${serviceId}/update-status`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                data: {
                    status: newStatus,
                },
                success: function(response) {
                    swal.fire({
                        icon: 'success',
                        title: 'Service Status Updated',
                        text: 'The service status has been updated successfully.',
                        timer: 1500,
                        showConfirmButton: false,
                    })
                    updateStatusClass(select.closest('tr'), newStatus);
                },
                error: function(xhr) {
                    console.error('Error updating service status.');
                }
            });
        });
    });
});
</script>
@endsection
