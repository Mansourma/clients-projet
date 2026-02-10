@extends('partials.app')
@section('title', 'Edit Admin')
@section('main')
<style>
    body {
        background-color: #f4f4f4;
    }

    .custom-form-container {
        width: 100%;
        height: auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 50px;
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
        border-color: #D3AC47;
        color: #000;
    }

    .btn-primary:hover {
        background-color: #b89a3a;
        border-color: #a6822d;
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
    .drag-drop-container {
        border: 2px dashed #D3AC47;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background-color: #f9f9f9;
        position: relative;
        cursor: pointer;
        overflow: hidden;
    }

    .drag-drop-container:hover {
        background-color: #e9e9e9;
    }

    .drag-drop-container svg {
        width: 50px;
        height: 50px;
        margin-bottom: 10px;
        color: #D3AC47;
    }

    .drag-drop-container p {
        font-size: 1rem;
        color: #555;
    }

    .drag-drop-container input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
</style>

<div class="container custom-form-container">
    <h1 class="mb-4 text-center">Edit Admin</h1>
    <form action="{{ route('admins.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name" class="form-label">Last Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $admin->name }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="prenom" class="form-label">First Name</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="{{ $admin->prenom }}" required>
            </div>
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="super_admin" {{ $admin->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="{{ $admin->date_of_birth }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cin" class="form-label">CIN</label>
                <input type="text" id="cin" name="cin" class="form-control" value="{{ $admin->cin }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $admin->email }}" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="drag-drop-container">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <p>Drag and drop an image or click to select one</p>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
            </div>

        </div>

        <div class="text-start">
            <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save"></i> Update</button>
            <a href="{{ route('admins.index') }}" class="btn btn-danger">
                <i class="fas fa-times-circle"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection
