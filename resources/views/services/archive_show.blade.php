@extends('partials.app')

@section('main')
<style>
    .custom-container {
        width: 95%;
        margin: 20px auto;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-header {
        color: #333;
        font-size: 2.5rem;
        margin-bottom: 20px;
        font-weight: 600;
        text-align: center;
    }

    .custom-card {
        background-color: #fff;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .custom-card-header {
        background-color: #D3AC47;
        color: #fff;
        padding: 15px;
        font-weight: 600;
        font-size: 1.2rem;
        text-align: center;
        border-bottom: 1px solid #b89a3a;
    }

    .custom-card-body {
        padding: 20px;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .custom-table th, .custom-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .custom-table th {
        background-color: #f9f9f9;
        color: #555;
    }

    .custom-table td {
        color: #333;
    }

    .btn-dark, .btn-black, .btn-gold, .btn-outline-gold {
    background-color: #000000;
    color: #D3AC47;
    transition: background-color 0.3s, color 0.3s;
}

.btn-dark:hover, .btn-black:hover, .btn-gold:hover, .btn-outline-gold:hover {
    background-color: #D3AC47;
    color: #000000;
    border: #D3AC47;
}

</style>



<div class="custom-container">
    <h1 class="custom-header">Service Archive Details</h1>

    <div class="custom-card">
        <div class="custom-card-header">
            Archive Details for Service: {{ $archive->service_name }} ({{ $archive->service_code }})
        </div>
        <div class="custom-card-body">
            <table class="custom-table">
                <tr>
                    <th>Service ID:</th>
                    <td>{{ $archive->service_id }}</td>
                </tr>
                <tr>
                    <th>Client ID:</th>
                    <td>{{ $archive->client_id }}</td>
                </tr>
                <tr>
                    <th>Service Name:</th>
                    <td>{{ $archive->service_name }}</td>
                </tr>
                <tr>
                    <th>Service Code:</th>
                    <td>{{ $archive->service_code }}</td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td>{{ $archive->price }} DH</td>
                </tr>
                <tr>
                    <th>Payment Type:</th>
                    <td>{{ $archive->payment_type }}</td>
                </tr>
                <tr>
                    <th>Service Description:</th>
                    <td>{{ $archive->service_description }}</td>
                </tr>
                <tr>
                    <th>Due Date:</th>
                    <td>{{ $archive->due_date }}</td>
                </tr>
                <tr>
                    <th>Last Payment:</th>
                    <td>{{ $archive->dernier_paiement }}</td>
                </tr>
                <tr>
                    <th>Subscription Duration:</th>
                    <td>{{ $archive->subscription_duration }} months</td>
                </tr>
                <tr>
                    <th>Services Status:</th>
                    <td>{{ $archive->services_status }}</td>
                </tr>
                <tr>
                    <th>Payment Status:</th>
                    <td>{{ $archive->payment_status }}</td>
                </tr>
                <tr>
                    <th>Validation Status:</th>
                    <td>{{ $archive->validation_status }}</td>
                </tr>
                <tr>
                    <th>Service Start Date:</th>
                    <td>{{ $archive->service_start_date }}</td>
                </tr>
                <tr>
                    <th>Service End Date:</th>
                    <td>{{ $archive->service_end_date }}</td>
                </tr>
                <tr>
                    <th>Invoice Number:</th>
                    <td>{{ $archive->invoice_number }}</td>
                </tr>
                <tr>
                    <th>Formatted ID:</th>
                    <td>{{ $archive->formatted_id }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>{{ $archive->status }}</td>
                </tr>
                <tr>
                    <th>Month/Year:</th>
                    <td>{{ $archive->month_year }}</td>
                </tr>
            </table>

            <a href="{{ route('services_archive.client', $archive->client_id) }}" class="btn btn-dark">Back to Archive List</a>
        </div>
    </div>
</div>
@endsection
