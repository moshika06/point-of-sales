<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();
        return view('roles.index', compact('roles'));
    }
    public function create()
    {
        return view('roles.create');
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|max:255',]);
        Role::create(['name' => $request->name,]);
        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan');
    }
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }
    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|max:255',]);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('roles.index')->with('warning', 'Role berhasil diubah');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('danger', 'Role berhasil dihapus');
    }
}
