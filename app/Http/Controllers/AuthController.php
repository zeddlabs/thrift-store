<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Masuk',
            'categories' => Category::all(),
        ];

        return view('auth.login', $data);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function register()
    {
        $data = [
            'title' => 'Daftar',
            'categories' => Category::all(),
        ];

        return view('auth.register', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:customers'],
            'password' => ['required'],
            'whatsapp' => ['required', 'unique:customers'],
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'whatsapp' => $request->whatsapp,
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();

        return redirect()->route('home');
    }
}
