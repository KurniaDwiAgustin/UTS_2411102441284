<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $users = User::all(); // ambil semua data
    return view('pages.admin.users.index', compact('users'));
}
    /**
     * Show the form for creating a new resource.
     */
public function create()
    {
        //
        return view('pages.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
    {
        //
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role' => 'required'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::findOrFail($id);
        return view('pages.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
            $user = User::findOrFail($id);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role
    ]);

    return redirect()->route('users.index')->with('success', 'User berhasil diupdate');

    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('users.index')->with('success', 'User berhasil dihapus');   
    }
}