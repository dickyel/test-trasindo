<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nomor_telepon' => 'required|string|max:255',
            'nomor_sim' => 'required|string|max:255',
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => 'member', // Atur default role sebagai 'member'
            'nomor_telepon' => $request->input('nomor_telepon'),
            'nomor_sim' => $request->input('nomor_sim'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
