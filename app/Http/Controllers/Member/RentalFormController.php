<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;

class RentalFormController extends Controller
{
    //
    public function index()
    {
        return view('pages.member.rental');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_toko' => 'required|string',
        ]);
    
        $userId = auth()->id();
    
        // Cek apakah sudah ada toko rental untuk pengguna ini
        $rental = Rental::where('user_id', $userId)->first();
    
        if ($rental) {
            // Jika sudah ada, update data toko rental
            $rental->update([
                'nama_toko' => $request->input('nama_toko'),
                'alamat' => $request->input('alamat'),
                'nomor_toko' => $request->input('nomor_toko'),
            ]);
    
            $message = 'Toko Rental berhasil diupdate.';
        } else {
            // Jika belum ada, buat toko rental baru
            $rental = new Rental([
                'user_id' => $userId,
                'nama_toko' => $request->input('nama_toko'),
                'alamat' => $request->input('alamat'),
                'nomor_toko' => $request->input('nomor_toko'),
            ]);
    
            $rental->save();
    
            $message = 'Toko Rental berhasil dibuat.';
        }
    
        return back()->with('success', $message);
    }
    
    

}
