<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginControll extends Controller
{
    public function index() {
        return view('login');
    }


    // Login

    public function loginUser(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::guard('web')->attempt($credentials)) {
            return redirect('/')->with('success', 'Anda berhasil login');
        }

        return back()->with('error', 'Email dan password tidak sesuai');
    }

    public function loginAdmin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index')->with('success', 'Anda berhasil login sebagai admin');
        }

        return back()->with('error', 'Email dan password tidak sesuai');
    }



    // Register

    public function registerUser(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'nomor_telepon' => 'required',
        ]);

        // dd($request->all());

        // Membuat user baru di database
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registrasi berhasil! Anda telah login.');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
