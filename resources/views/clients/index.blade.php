@extends('partials.app')
@section('title', 'Clients')
@section('main')
<style>
.btn-dark,.btn-black,.btn-golden,.btn-outline-gold{background-color:#000;color:#D3AC47;transition:background-color .3s,color .3s}
.btn-dark:hover,.btn-black:hover,.btn-golden:hover,.btn-outline-gold:hover{background-color:#D3AC47;color:#000}
.btn-outline-gold{background-color:transparent;color:#D3AC47}
.btn-outline-gold:hover{background-color:#D3AC47;color:#000}
.btn-outline-black{color:#000}
.btn-outline-black:hover{background-color:#000;color:#D3AC47}
.dropdown-menu{border:1px solid #D3AC47}
.card{border-radius:.5rem}
.card-title{font-size:1.25rem;color:#D3AC47}
.card-text{font-size:1.5rem;color:inherit}
.bg-custom{background-color:#000}
.bg-gold{background-color:#D3AC47;color:#000}
.table thead th{background-color:#D3AC47;color:#000}
.dropdown-item{display:flex;align-items:center}
.dropdown-item i{margin-right:10px}
</style>
<div class="container-fluid main-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4">Clients</h1>
        <a href="{{ route('clients.create') }}" class="btn btn-dark btn-lg">Add New Client</a>
    </div>
    <form action="{{ route('clients.index') }}" method="GET" class="row g-2 mb-4 align-items-end">
        <div class="col-md-6">
            <input type="text" name="search_code" id="search_code" class="form-control" placeholder="Search by Client Code" value="{{ $searchCode }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-50">Search</button>
        </div>
    </form>
    <div class="btn-group mb-4" role="group" aria-label="Filter Clients">
        <a href="{{ route('clients.index', ['search_code' => request('search_code')]) }}" class="btn {{ !request('type') ? 'btn-golden' : 'btn-black' }}">All Clients</a>
        <a href="{{ route('clients.index', ['type' => 'society']) }}" class="btn btn-golden">Enterprise Clients</a>
        <a href="{{ route('clients.index', ['type' => 'individual']) }}" class="btn btn-black">Individual Clients</a>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-custom">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users" style="font-size:2rem"></i> Total Clients</h5>
                    <p class="card-text" style="color:#D3AC47">{{ $totalClients }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-gold text-black">
                <div class="card-body">
                    <h5 class="card-title" style="color:#000"><i class="fas fa-user" style="font-size:2rem;color:#000"></i> Total Individual Clients</h5>
                    <p class="card-text">{{ $totalIndividualClients }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-custom">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-building" style="font-size:2rem"></i> Total Enterprise Clients</h5>
                    <p class="card-text" style="color:#D3AC47">{{ $totalEnterpriseClients }}</p>
                </div>
            </div>
        </div>
    </div>
    <h2 class="mb-4">
        @if (request('type') === 'individual')
            List of Individual Clients
        @elseif (request('type') === 'society')
            List of Enterprise Clients
        @else
            List of All Clients
        @endif
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-warning table-bordered">
            <thead>
                <tr>
                    <th>Client Code</th>
                    <th>Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>CNI</th>
                    <th>Client Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($individualClients as $client)
                <tr>
                    <td>{{ $client->code_client }}</td>
                    <td>{{ $client->name_client }}</td>
                    <td>{{ $client->prenom_client }}</td>
                    <td>{{ $client->email_client }}</td>
                    <td>{{ $client->telephone_client }}</td>
                    <td>{{ $client->cin_client }}</td>
                    <td>{{ $client->client_type }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-black dropdown-toggle" type="button" id="dropdownMenuButton{{ $client->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $client->id }}">
                                <li><a class="dropdown-item" href="{{ route('clients.show', $client->id) }}"><i class="fas fa-eye"></i> View</a></li>
                                <li><a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="{{ route('services.create', ['client_id' => $client->id]) }}"><i class="fas fa-plus"></i> Add Service</a></li>
                                <li><a class="dropdown-item" href="{{ route('services_archive.client', $client->id) }}"><i class="fas fa-archive"></i> View Archives</a></li>
                                @if(!Auth::user()->isAdmin())
                                <form id="delete-form-{{ $client->id }}" action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="dropdown-item delete-btn text-danger" data-form-id="{{ $client->id }}"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
                @foreach($enterpriseClients as $client)
                <tr>
                    <td>{{ $client->code_client }}</td>
                    <td>{{ $client->legal_representative_name_enterprise }}</td>
                    <td>{{ $client->legal_representative_prenom_enterprise }}</td>
                    <td>{{ $client->legal_representative_email_enterprise }}</td>
                    <td>{{ $client->telephone_enterprise }}</td>
                    <td>{{ $client->legal_representative_cin_enterprise }}</td>
                    <td>{{ $client->client_type == 'individual' ? $client->client_type : $client->society_type }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-black dropdown-toggle" type="button" id="dropdownMenuButton{{ $client->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $client->id }}">
                                <li><a class="dropdown-item" href="{{ route('clients.show', $client->id) }}"><i class="fas fa-eye"></i> View</a></li>
                                <li><a class="dropdown-item" href="{{ route('clients.edit', $client->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="{{ route('services.create', ['client_id' => $client->id]) }}"><i class="fas fa-plus"></i> Add Service</a></li>
                                <li><a class="dropdown-item" href="{{ route('services_archive.client', $client->id) }}"><i class="fas fa-archive"></i> View Archives</a></li>
                                <form id="delete-form-{{ $client->id }}" action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="dropdown-item delete-btn text-danger" data-form-id="{{ $client->id }}"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row justify-content-end">
    {{ $clients->links() }}
</div>
@endsection
