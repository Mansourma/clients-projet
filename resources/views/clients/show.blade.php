@extends('partials.app')

@section('title', 'Client Details')

@section('main')
<style>
    /* Default button styles */
    .btn-dark, .btn-black, .btn-gold, .btn-outline-gold {
        background-color: #000000;
        color: #D3AC47;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Hover state */
    .btn-dark:hover, .btn-black:hover, .btn-gold:hover, .btn-outline-gold:hover {
        background-color: #D3AC47;
        color: #000000;
    }

    .btn-outline-gold {
        background-color: transparent;
        color: #D3AC47;
    }

    .btn-outline-gold:hover {
        background-color: #D3AC47;
        color: #000000;
    }

    /* Dropdown and other buttons */
    .btn-outline-black {
        color: #D3AC47;
        background-color: #000000;
    }

    .btn-outline-black:hover {
        background-color: #D3AC47;
        color: #000000;
    }

    /* Additional styles for dropdown items */
    .dropdown-menu {
        border: 1px solid #D3AC47;
    }

    /* Card and Table Styles */
    .card-header {
        background-color: #D3AC47;
        color: #000000;
    }

    .card-body {
        background-color: #f8f9fa;
    }

    .table thead {
        background-color: #D3AC47;
        color: #000000;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table tbody tr:hover {
        background-color: #e2e2e2;
    }

    .btn-edit {
        background-color: #000000;
        color: #D3AC47;
    }

    .btn-edit, .btn-return:hover {
        background-color: #000000;
        color: #D3AC47;
    }

    .btn-return {
        background-color: #000000;
        color: #D3AC47;
    }

    .custom-container {
        width: 95%;
        margin: 0 auto;
        padding: 20px;
    }
</style>

<div class="custom-container mt-2">
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h4 class="mb-0">{{ $client->name_client ?? $client->enterprise_name }} ({{ $client->code_client }})</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if ($client->client_type == 'individual')
                        <p><strong>First Name:</strong> {{ $client->prenom_client }}</p>
                        <p><strong>Last Name:</strong> {{ $client->name_client }}</p>
                        <p><strong>Email:</strong> {{ $client->email_client }}</p>
                        <p><strong>Phone:</strong> {{ $client->telephone_client }}</p>
                        <p><strong>Secondary Phone:</strong> {{ $client->secondary_telephone_client }}</p>
                        <p><strong>CIN:</strong> {{ $client->cin_client }}</p>
                        <p><strong>Gender:</strong> {{ $client->genre_client }}</p>
                        <p><strong>Sector of Work:</strong> {{ $client->sector_of_work_client }}</p>
                        <p><strong>Date of Birth:</strong> {{ $client->date_of_birth_client }}</p>
                    @elseif ($client->client_type == 'society')
                        <p><strong>Enterprise Name:</strong> {{ $client->enterprise_name }}</p>
                        <p><strong>ICE:</strong> {{ $client->ice_enterprise }}</p>
                        <p><strong>Tax Identification Number:</strong> {{ $client->tax_identification_number_enterprise }}</p>
                        <p><strong>Phone:</strong> {{ $client->telephone_enterprise }}</p>
                        <p><strong>Secondary Phone:</strong> {{ $client->secondary_telephone_enterprise }}</p>

                        <p><strong>Legal Representative Full Name:</strong> {{ $client->legal_representative_name_enterprise }} {{ $client->legal_representative_prenom_enterprise }}</p>
                        <p><strong>Legal Representative Position:</strong> {{ $client->legal_representative_position_enterprise }}</p>
                        <p><strong>Legal Representative CIN:</strong> {{ $client->legal_representative_cin_enterprise }}</p>
                        <p><strong>Legal Representative Nationality:</strong> {{ $client->legal_representative_nationality_enterprise }}</p>
                        <p><strong>Legal Representative Email:</strong> {{ $client->legal_representative_email_enterprise }}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <p><strong>Client Type:</strong> {{ $client->client_type }}</p>
                    @if($client->client_type == 'society')
                    <p><strong>Society Type:</strong> {{ $client->society_type }}  </p>
                    @endif
                    <p><strong>Sector of Activity:</strong> {{ $client->sector_of_work_client ?? $client->enterprise_sector }}</p>
                    <p><strong>Address Line 1:</strong> {{ $client->address_client ?? $client->address_enterprise }}</p>
                    <p><strong>Address Line 2:</strong> {{ $client->address_client2 ?? $client->address_enterprise2 }}</p>
                    <p><strong>Registration Time:</strong> {{ $client->registration_datetime_client ?? $client->registration_datetime_enterprise }}</p>
                    <p><strong>Created At:</strong> {{ $client->created_at }}</p>
                    <p><strong>Updated At:</strong> {{ $client->updated_at }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light">
            <a href="{{ route('clients.index') }}" class="btn btn-return btn-lg me-2"><i class="fas fa-arrow-left mr-2"></i>Back to Clients List</a>
            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-edit btn-lg"><i class="fas fa-edit mr-2"></i>Edit</a>
        </div>
    </div>

    <div class="mb-4">
        <h2 class="display-5">Service Archives</h2>
        @foreach ($archives as $archive)
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1"><strong>Service ID:</strong> {{ $archive->service_id }}</p>
                    <p class="mb-1"><strong>Month/Year:</strong> {{ $archive->month_year }}</p>
                </div>
                <div>
                    <a class="btn btn-outline-black btn-sm me-2" href="{{ route('download.invoice', $archive->service_id) }}">
                        <i class="fas fa-file-invoice me-1"></i> Download Invoice
                    </a>
                    <a href="{{ route('services-archive.show', ['service_id' => $archive->service_id, 'client_id' => $archive->client_id, 'month_year' => $archive->month_year]) }}" class="btn btn-outline-black btn-sm">
                        <i class="fas fa-eye me-1"></i> View
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $archives->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var formId = $(this).data('form-id');
                if (confirm('Are you sure you want to delete this client?')) {
                    $('#delete-form-' + formId).submit();
                }
            });
        });
    </script>
@endsection
