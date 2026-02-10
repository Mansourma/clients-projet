@extends('partials.app')
@section('title', 'Admins')
@section('main')
<style>

    .btn-black{
        background-color: #000000;
        color: #D3AC47;
    }

    .btn-black:hover{
        background-color: #D3AC47;
        color: #000000;
    }
    .btn-outline-black {
    color: #000000;
}

.btn-outline-black:hover {
    background-color: #000000;
    color: #D3AC47;
}

</style>
<div class="container-fluid main-container">
    @if (auth()->user()->role === 'super_admin')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Admins</h1>
        <a href="{{ route('admins.create') }}" class="btn btn-black mb-3" id="btn">Add Admin</a>
    </div>

        <div class="table-container">
            <table class="table table-striped table-warning table-bordered">
                <thead>
                    <tr style="background:#D3AC47;">
                        <th>#</th>
                        <th>Name</th>
                        <th>Prenom</th>
                        <th>Age</th>
                        <th>Date of Birth</th>
                        <th>CIN</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->prenom }}</td>
                        <td>{{ $admin->age }}</td>
                        <td>{{ $admin->date_of_birth }}</td>
                        <td>{{ $admin->cin }}</td>
                        <td>{{ $admin->email }}</td>
                        <td>{{ $admin->role }}</td>
                        <td>
                            @if ($admin->image)
                            <img src="{{ asset('storage/' . $admin->image) }}" alt="{{ $admin->name }}" width="50" class="rounded-circle">
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-black dropdown-toggle" type="button" id="dropdownMenuButton{{ $admin->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span> <!-- Screen reader text -->
                                    <span class="dropdown-toggle-icon">⋮</span> <!-- Three vertical dots -->
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $admin->id }}">
                                    <li><a class="dropdown-item" href="{{ route('admins.show', $admin->id) }}"><i class="fa fa-eye"></i> View</a></li>

                                    {{-- Edit and Delete buttons (visible only to super admins) --}}
                                    @if (auth()->user()->role === 'super_admin')
                                    <li><a class="dropdown-item" href="{{ route('admins.edit', $admin->id) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                    <li>
                                        <form id="delete-form-{{ $admin->id }}" action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item delete-btn text-danger" data-form-id="{{ $admin->id }}"><i class="fa fa-trash"></i> Supprimer</button>
                                        </form>
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
    @endif
</div>

@endsection

