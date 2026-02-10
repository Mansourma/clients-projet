@extends('partials.app')
@section('title', 'Edit Service')
@section('main')

<style>
    body {
        background-color: #f4f4f4;
    }

    .custom-form-container {
        height: auto;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .custom-form-container h1 {
        color: #000;
        font-size: 2rem;
        border-bottom: 2px solid #D3AC47;
        padding-bottom: 10px;
    }

    .form-row {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: bold;
        color: #000;
    }

    .form-control {
        border-color: #D3AC47;
        border-radius: 4px;
    }

    .form-control:focus {
        border-color: #D3AC47;
        box-shadow: 0 0 0 0.2rem rgba(211, 172, 71, 0.25);
    }

    .text-danger {
        font-size: 0.875rem;
        margin-top: 0.25rem;
        color: #dc3545;
    }

    .btn-primary {
        background-color: #D3AC47;
        color: #000;
    }

    .btn-primary:hover {
        background-color: #b89a3a;
    }

    .btn-primary:focus, .btn-primary.focus {
        box-shadow: 0 0 0 0.2rem rgba(211, 172, 71, 0.5);
    }

    .client-fields {
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .custom-select {
        border-color: #D3AC47;
        border-radius: 4px;
        padding: 0.5rem 1rem;
        appearance: none;
        background-color: white;
        box-shadow: none;
    }

    .custom-select:focus {
        border-color: #D3AC47;
        box-shadow: 0 0 0 0.2rem rgba(211, 172, 71, 0.25);
    }

    .custom-select::after {
        content: "\f078";
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-family: FontAwesome;
        pointer-events: none;
    }

    .selected {
        background-color: white;
    }

    .btn-black {
        background-color: #000;
        color: #D3AC47;
    }

    .btn-black:hover {
        background-color: #D3AC47;
        color: #000;
    }
</style>

<div class="container mt-5 custom-form-container">
    <h1 class="mb-4">Edit Service</h1>

    <form action="{{ route('services.update', $service->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <!-- Service Status -->
            <div class="col-md-6">
                <label for="services_status" class="form-label">Service Status:</label>
                <select name="services_status" id="services_status" class="form-select custom-select">
                    <option value="waiting" {{ $service->services_status === 'waiting' ? 'selected' : '' }}>Waiting</option>
                    <option value="in progress" {{ $service->services_status === 'in progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="to do" {{ $service->services_status === 'to do' ? 'selected' : '' }}>To Do</option>
                    <option value="done" {{ $service->services_status === 'done' ? 'selected' : '' }}>Done</option>
                </select>
                @error('services_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Payment Status -->
            <div class="col-md-6">
                <label for="payment_status" class="form-label">Payment Status:</label>
                <select name="payment_status" id="payment_status" class="form-select custom-select">
                    <option value="payé" {{ $service->payment_status === 'payé' ? 'selected' : '' }}>Paid</option>
                    <option value="non payé" {{ $service->payment_status === 'non payé' ? 'selected' : '' }}>Not Paid</option>
                    <option value="subscription end" {{ $service->payment_status === 'subscription end' ? 'selected' : '' }}>Subscription End</option>
                </select>
                @error('payment_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <!-- Validation Status -->
            <div class="col-md-6">
                <label for="validation_status" class="form-label">Validation Status:</label>
                <select name="validation_status" id="validation_status" class="form-select custom-select">
                    <option value="en cours" {{ $service->validation_status === 'en cours' ? 'selected' : '' }} @disabled(true)>In Progress</option>
                    <option value="validé" {{ $service->validation_status === 'validé' ? 'selected' : '' }}>Valid</option>
                    <option value="non-validé" {{ $service->validation_status === 'non-validé' ? 'selected' : '' }}>Not Valid</option>
                </select>
                @error('validation_status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn-black btn-lg">Update</button>
    </form>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var selectElements = document.querySelectorAll('.custom-select');
    selectElements.forEach(function (select) {
        select.addEventListener('change', function () {
            this.classList.add('selected');
        });
    });
});
</script>
@endsection

@endsection
