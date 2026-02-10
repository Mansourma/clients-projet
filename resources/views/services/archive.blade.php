@extends('partials.app')

@section('main')
<style>
    .custom-container {
        padding: 20px;
        background-color: #f4f4f4; /* Optional: Adjust based on your design */
    }

    .custom-title {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #333;
        font-weight: bold;
    }

    .custom-table-responsive {
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .thead {
        background-color: #D3AC47; /* Main color for table header */
        color: #000000; /* Text color in header */
    }

    .custom-table th,
    .custom-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .custom-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f1f1;
    }



    .pagination-wrapper {
        margin-top: 20px;
        text-align: center;
    }


.btn-golden {
    background-color: #000000;
    color: #D3AC47;
}

.btn-golden:hover {
    background-color: #D3AC47;
    color: #000000;
    transition: background-color 0.3s, color 0.3s;
}
</style>

<div class="custom-container">
    <h1 class="custom-title">{{ $title ?? 'Services Archive' }}</h1>
    <div class="custom-table-responsive">
        <table class="custom-table">
            <thead class="thead">
                <tr>
                    <th>Service ID</th>
                    <th>Client ID</th>
                    <th>Service Name</th>
                    <th>Service Code</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Validation Status</th>
                    <th>Month/Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archives as $archive)
                <tr>
                    <td>{{ $archive->service_id }}</td>
                    <td>{{ $archive->client_id }}</td>
                    <td>{{ $archive->service_name }}</td>
                    <td>{{ $archive->service_code }}</td>
                    <td>{{ $archive->price }}</td>
                    <td>{{ $archive->payment_status }}</td>
                    <td>{{ $archive->validation_status }}</td>
                    <td>{{ $archive->month_year }}</td>
                    <td>
                        <a href="{{ route('services-archive.show', ['service_id' => $archive->service_id, 'client_id' => $archive->client_id, 'month_year' => $archive->month_year]) }}" class="btn btn-golden">
                          View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $archives->links() }}
    </div>
</div>
@endsection


