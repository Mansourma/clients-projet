<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'cin' => 'required|string|unique:admins',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image',
            'role' => 'required|in:super_admin,admin',
        ]);

        $dateOfBirth = new \DateTime($request->input('date_of_birth'));
        $now = new \DateTime();
        $age = $now->diff($dateOfBirth)->y;

        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->prenom = $request->input('prenom');
        $admin->age = $age;
        $admin->date_of_birth = $request->input('date_of_birth');
        $admin->cin = $request->input('cin');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $admin->image = $path;
        }

        $admin->role = $request->input('role');
        $admin->save();
        return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
    }


    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'cin' => 'required|string|unique:admins,cin,' . $id,
            'email' => 'required|string|email|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image',
            'role' => 'required|in:super_admin,admin',
        ]);

        $admin = Admin::findOrFail($id);

        $dateOfBirth = new \DateTime($request->input('date_of_birth'));
        $now = new \DateTime();
        $age = $now->diff($dateOfBirth)->y;

        $admin->name = $request->input('name');
        $admin->prenom = $request->input('prenom');
        $admin->age = $age; 
        $admin->date_of_birth = $request->input('date_of_birth');
        $admin->cin = $request->input('cin');
        $admin->email = $request->input('email');

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $admin->image = $path;
        }

        $admin->role = $request->input('role');
        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
    }
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admins.show', compact('admin'));
    }
}
