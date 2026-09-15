<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // SELECT
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    // FORM INSERT
    public function create()
    {
        return view('users.create');
    }

    // INSERT
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    // FORM UPDATE
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // UPDATE
    public function update(Request $request, User $user)
    {
        $request->validate(['name' => 'required', 'email' => 'required|email|unique:users,email,' . $user->id,]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('warning', 'User berhasil diubah');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('danger', 'User berhasil dihapus');
    }
}
