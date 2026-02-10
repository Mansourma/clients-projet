@extends('partials.app')
@section('title', 'Services')
@section('main')
<style>
    .form-control {
        border-color: #D3AC47;
        border-radius: 4px;
    }
    .form-control:focus {
        border-color: #D3AC47;
        box-shadow: 0 0 0 0.2rem rgba(211, 172, 71, 0.25);
    }
    .btn-custom {
        background-color: #000;
        color: #D3AC47;
        border-radius: 4px;
    }
    .btn-custom:hover {
        background-color: #D3AC47;
        color: #000;
        border-radius: 4px;
    }
    .bg-custom {
        background-color: #000000;
        border-radius: 8px;
    }
    .bg-gold {
        background-color: #D3AC47;
        border-radius: 8px;
    }
    .btn-black {
        background-color: #000000;
        color: #D3AC47;
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
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }
    .btn-golden:hover {
        background-color: #000000;
        color: #D3AC47;
        border-color: #D3AC47;
    }
    .btn-outline-black {
        color: #000000;
    }
    .btn-outline-black:hover {
        background-color: #000000;
        color: #D3AC47;
    }
    .card {
        margin-bottom: 20px;
    }
    .table {
        margin-top: 20px;
    }
    .table th {
        background-color: #D3AC47;
        color: #000000;
    }
    .pagination-text {
        margin-top: 10px;
    }
</style>

<div class="container-fluid main-container">
    <h2 class="my-4">Search Services</h2>
    <form method="GET" action="{{ route('services.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by code Client, name, service name or enterprise" value="{{ request()->input('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-custom">Search</button>
            </div>
        </div>
    </form>

    <div class="mb-4">
        <a href="{{ route('services.index', ['is_subscription' => '1']) }}" class="btn btn-black me-2">View Subscribed Services</a>
        <a href="{{ route('services.index', ['is_subscription' => '0']) }}" class="btn btn-golden me-2">View Non-Subscribed Services</a>
        <a href="{{ route('services.index') }}" class="btn btn-black me-2">View All Services</a>
        <a href="{{ route('services.index', ['is_subscription' => '0', 'status' => 'to do']) }}" class="btn btn-golden me-2">Purchase Order</a>
        <a href="{{ route('services.index', ['status' => 'archivé']) }}" class="btn btn-black">View Archived Services</a>
    </div>

    <h2 class="my-4">Service Totals</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-custom text-center">
                <div class="card-body">
                    <i class="fas fa-clipboard-list" style="color: #D3AC47; font-size: 2rem;"></i>
                    <h5 class="card-title" style="color: #D3AC47;">Total Services</h5>
                    <p class="card-text" style="color: #D3AC47;">{{ $totalServices }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-gold text-center">
                <div class="card-body">
                    <i class="fas fa-dollar-sign" style="color: #000000; font-size: 2rem;"></i>
                    <h5 class="card-title" style="color: #000000;">Total Price</h5>
                    <p class="card-text" style="color: #000000;">{{ $totalPrice }} DH</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-custom text-center">
                <div class="card-body">
                    <i class="fas fa-clock" style="color: #D3AC47; font-size: 2rem;"></i>
                    <h5 class="card-title" style="color: #D3AC47;">Purchase Order</h5>
                    <p class="card-text" style="color: #D3AC47;">{{ $totalAfairNonAbonne }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-custom text-center">
                <div class="card-body">
                    <i class="fas fa-user" style="color: #D3AC47; font-size: 2rem;"></i>
                    <h5 class="card-title" style="color: #D3AC47;">Non-Subscribed Services</h5>
                    <p class="card-text" style="color: #D3AC47;">{{ $totalNonAbonne }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-gold text-center">
                <div class="card-body">
                    <i class="fas fa-user-check" style="color: #000000; font-size: 2rem;"></i>
                    <h5 class="card-title" style="color: #000000;">Subscribed Services</h5>
                    <p class="card-text" style="color: #000000;">{{ $totalAbonne }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-custom text-center">
                <div class="card-body">
                    <i class="fas fa-archive" style="color: #D3AC47; font-size: 2rem;"></i>
                    <h5 class="card-title" style="color: #D3AC47;">Archived Services</h5>
                    <p class="card-text" style="color: #D3AC47;">{{ $archivedServices }}</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="my-4">
        @if(request()->query('is_subscription') === '1')
            Subscribed Services
        @elseif(request()->query('is_subscription') === '0')
            Non-Subscribed Services
        @elseif(request()->query('status') === 'archivé')
            Archived Services
        @else
            All Services
        @endif
    </h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-warning">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Client</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Service Type</th>
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
                        @if($service->is_subscription == 0)
                            Non-Subscribed
                        @elseif($service->is_subscription == 1)
                            Subscribed
                        @endif
                    </td>
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
                        <select class="form-control service-status-select" data-service-id="{{ $service->id }}" data-old-status="{{ $service->services_status }}"
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
                                @if(($service->services_status === 'to do') && $service->is_subscription === 0)
                                <li>
                                    <a class="dropdown-item" href="{{ route('client.downloadOrder', ['clientId' => $service->client_id, 'serviceId' => $service->id]) }}">
                                        <i class="fas fa-download me-2"></i> Download Order
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
    </div>

    <div class="d-flex justify-content-between align-items-center my-4">
        <div class="table-pagination">
            {{ $services->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        <p class="pagination-text mb-0">Showing {{ $services->count() }} out of {{ $totalServices }} results</p>
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function toggleButtonValue(button) {
        const newStatus = button.textContent.trim() === 'validé' || button.textContent.trim() === 'non-validé'
                          ? (button.textContent.trim() === 'validé' ? 'non-validé' : 'validé')
                          : (button.textContent.trim() === 'payé' ? 'non payé' : 'payé');

        button.textContent = newStatus;
        button.classList.toggle('btn-success');
        button.classList.toggle('btn-danger');
        if (newStatus === 'en cours') {
            button.classList.remove('btn-danger', 'btn-success');
            button.classList.add('btn-warning');
        }

        return newStatus;
    }

    function sendStatusToServer(serviceId, type, status) {
        $.ajax({
            url: `/update-${type}-status/${serviceId}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
            data: JSON.stringify({ status: status }),
            success: function(response) {
                console.log(`Statut ${type} mis à jour avec succès.`);
            },
            error: function(xhr) {
                console.error(`Erreur lors de la mise à jour du statut ${type}.`);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.toggle-button').forEach(button => {
            button.addEventListener('click', () => {
                const serviceId = button.dataset.serviceId;
                const type = button.dataset.type;

                let newStatus;
                if (type === 'payment') {
                    newStatus = toggleButtonValue(button);
                    sendStatusToServer(serviceId, 'payment', newStatus);
                    if (newStatus === 'payé') {
                        sendStatusToServer(serviceId, 'validation', 'en cours');
                        $(`#service-row-${serviceId} .toggle-button[data-type="validation"]`).text('en cours').removeClass('btn-success btn-danger').addClass('btn-warning');
                    }
                } else {
                    newStatus = toggleButtonValue(button);
                    sendStatusToServer(serviceId, 'validation', newStatus);
                }
            });
        });
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.querySelectorAll('.service-status-select').forEach(select => {
        select.addEventListener('change', function() {
            const serviceId = this.dataset.serviceId;
            const newStatus = this.value;
            const oldStatus = this.dataset.oldStatus;

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
                    console.log('AJAX response:', response);

                    if ((newStatus === 'to do' && response.is_subscription === 0) ||
                        (oldStatus === 'to do' && newStatus !== 'to do' && response.is_subscription === 0)) {
                        swal.fire({
                            icon: 'success',
                            title: 'Service Status Updated',
                            text: 'The page will reload to reflect the changes.',
                            timer: 1000,
                            showConfirmButton: false,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        swal.fire({
                            icon: 'success',
                            title: 'Service Status Updated',
                            text: 'The service status has been updated successfully.',
                            timer: 1500,
                            showConfirmButton: false,
                        });
                        select.dataset.oldStatus = newStatus;
                    }
                },
                error: function(xhr) {
                    console.error('Error updating service status:', xhr);
                    swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update service status. Please try again.',
                    });
                }
            });
        });
    });
});

</script>
@endsection


