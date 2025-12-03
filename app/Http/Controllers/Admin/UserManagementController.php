<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // TAMPILKAN SEMUA USER
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
            })
            ->when($request->role, function ($q) use ($request) {
                $q->where('role', $request->role);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // supaya filter tetap ada saat pindah halaman

        return view('admin.usermanagement', compact('users'));
    }


    // FORM CREATE USER
    public function create()
    {
        return view('admin.users.create');
    }

    // SIMPAN USER BARU
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'phone' => 'required',
        'address' => 'required',
        'role' => 'required'
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'phone' => $validated['phone'],
        'address' => $validated['address'],
        'role' => $validated['role'],
    ]);

    return redirect()->route('admin.usermanagement')
                     ->with('success', 'Pengguna berhasil ditambahkan!');
}



    // FORM EDIT USER
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // UPDATE USER
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->role = $request->role;

    $user->save();

    return redirect()->route('admin.usermanagement')->with('success', 'Data pengguna berhasil diperbarui!');
}


    // DELETE USER
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.usermanagement')->with('success', 'User berhasil dihapus!');
    }
}
