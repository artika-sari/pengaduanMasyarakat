<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    

     public function regis(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('reports')->with('success', 'You are already logged in!');
        }

        return view('regis');
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), 
        ]);

        auth()->login($user);

        return redirect()->route('reports')->with('success', 'Akun berhasil dibuat!');
    }


    public function loginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('reports')->with('info', 'You are already logged in!');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->intended(route('reports'))->with('success', 'Login berhasil!');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'You have successfully logged out!');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
