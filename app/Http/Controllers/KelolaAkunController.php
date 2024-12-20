<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KelolaAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view ('headstaff.kelolaAkun', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $province = Auth::user()->StaffProvince->province ??null;
        // if (!$province) {
        //     return redirect()->route('loginAuth')->with('failed', 'Provinsi tidak ditemukan pada akun anda');
        // }

        // $user = User::where('role', 'STAFF')->whereHas('StaffProvince', function ($query) use ($province) {$query->where('province', $province);})->get();
        return view('headstaff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'nullable',
        ], [
            'email.required' => 'Email harus diisi!',
            'email.unique' => 'Email harus berbeda!'
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'STAFF',
        ]);
            return redirect()->route('data.staff')->with('success', 'Account data has been added');
        
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    public function Reset($id)
    {
        $user = User::find($id);
    if ($user) {
        $newPassword = substr($user->email, 0, 4); 
        $user->password = bcrypt($newPassword);
        $user->save();
        return redirect()->back()->with('success', 'Password berhasil direset!');
    }
    return redirect()->back()->with('error', 'User tidak ditemukan!');
    }


    public function destroy($id)
    {
        $users = User::find($id);

        if ($users) {
            $users->delete();
            return redirect()->route('data.staff')->with('success', 'Akun brehasil di hapus!');
        }
    
    
        return redirect()->route('data.staff')->with('error', 'Akun tidak ditemukan!');
    }
}
