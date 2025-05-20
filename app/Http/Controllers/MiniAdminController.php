<?php

namespace App\Http\Controllers;

use App\Models\MiniAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MiniAdminController extends Controller
{
    public function index()
    {
        $miniAdmins = MiniAdmin::all();
        $permissions = config('permissions.mini_admin');
        return view('super-admin.mini-admin.index', compact('miniAdmins', 'permissions'));
    }

    public function edit(MiniAdmin $miniAdmin)
    {
        $permissions = config('permissions.mini_admin');
        return view('super-admin.mini-admin.edit', compact('miniAdmin', 'permissions'));
    }

    public function update(Request $request, MiniAdmin $miniAdmin)
    {
        $validated = $request->validate([
            'password' => ['nullable', 'confirmed'],
            'permissions' => ['array'],
        ]);
    
        if ($validated['password'] ?? false) {
            $miniAdmin->password = Hash::make($validated['password']);
        }
    
        $miniAdmin->permissions = $validated['permissions'] ?? [];
    
        $miniAdmin->save();
    
        $miniAdmin->logAction('permissions_updated', 'Updated permissions: ' . json_encode($validated['permissions']));
    
        return redirect()->route('super-admin.mini-admin.index')->with('success', 'MiniAdmin updated!');
    }

    public function destroy(MiniAdmin $miniAdmin)
    {
        $miniAdmin->delete();
        return back()->with('success', 'MiniAdmin deleted!');
    }
}
