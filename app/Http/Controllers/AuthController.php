<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\ElseIf_;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.pages.register');
    }

    public function registerStore(Request $request)
    {
        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah dimiliki, silahkan login!',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'password.max' => 'Password maksimal 16 karakter',
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:16',
            'role' => 'in:admin,staff,scan1,scan2', // Validasi role
        ], $messages);

        // Default role is 'staff' if not provided
        $role = $request->role ?? 'staff';

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Pastikan role diambil dari input
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil, silahkan login!');
    }

    public function login()
    {
        return view('auth.pages.login');
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on role
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'staff') {
                return redirect()->route('staff.dashboard');
            } elseif ($user->role == 'scan1') {
                return redirect()->route('scan1.dashboard');
            } elseif ($user->role == 'scan2') {
                return redirect()->route('scan2.dashboard');
            } elseif ($user->role == 'scan3') {
                return redirect()->route('scan3.dashboard');
            }
        } else {
            return back()->withInput()->with('error', 'Login gagal, silakan coba lagi.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Berhasil');
    }
}
