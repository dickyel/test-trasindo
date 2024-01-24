<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('pages.member.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],
            'nomor_telepon' => 'required|string',
            'nomor_sim' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'old_password' => 'nullable|string',
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable',
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->nomor_sim = $request->nomor_sim;
        $user->email = $request->email;

        if ($request->filled('password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Please isi password dengan benar')])
                    ->withInput();
            }
        }

        $user->save();

        return back()->with('status', 'Profile updated!');
    }
}
