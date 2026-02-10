@extends('partials.app')
@section('title', 'Admin Details')
@section('main')
<div class="container mt-5">
    <h1 class="mb-4 text-dark">Admin Details</h1>
    <div class="card shadow-sm border-light">
        <div class="card-header bg-dark text-warning">
            <h4 class="mb-0">{{ $admin->name }} {{ $admin->prenom }}</h4>
        </div>
        <div class="card-body bg-light text-dark">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <p><strong>Name:</strong> {{ $admin->name }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p><strong>Prenom:</strong> {{ $admin->prenom }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p><strong>Age:</strong> {{ $admin->age }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p><strong>Date of Birth:</strong> {{ $admin->date_of_birth }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p><strong>CIN:</strong> {{ $admin->cin }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <p><strong>Email:</strong> {{ $admin->email }}</p>
                </div>
                <div class="col-md-12 mb-3">
                    <p><strong>Role:</strong> {{ $admin->role }}</p>
                </div>
                @if ($admin->image)
                <div class="col-md-12 mb-3">
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/' . $admin->image) }}" alt="{{ $admin->name }}" class="img-fluid rounded-circle" style="max-width: 150px;">
                </div>
                @endif
            </div>
        </div>
    </div>
    @if(!Auth::user()->isAdmin())
    <a href="{{ route('admins.index') }}" class="btn btn-danger mt-4"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    @endif
    @if(Auth::user()->isAdmin())
    <a href="{{ route('home.home') }}" class="btn btn-danger mt-4"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    @endif


</div>
@endsection

<style>
.card-header {
    background-color: #000000;
    color: #D3AC47;
    border-radius: 8px 8px 0 0;
}

.card-body {
    background-color: #F7F7F7;
    color: #000000;
    border-radius: 0 0 8px 8px;
    padding: 20px;
}

.card {
    border: 2px solid #D3AC47;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #000000;
    font-size: 2rem;
    border-bottom: 2px solid #D3AC47;
    padding-bottom: 10px;
}

.btn-dark {
    background-color: #000000;
    color: #D3AC47;
    border: 2px solid #D3AC47;
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-dark:hover {
    background-color: #D3AC47;
    color: #000000;
    border-color: #000000;
}

.img-fluid {
    border: 2px solid #D3AC47;
    border-radius: 50%;
    padding: 5px;
}

</style>
