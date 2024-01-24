<?php

namespace App\Http\Controllers;

// app/Http/Controllers/PeminjamanController.php


use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\Peminjaman;


class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
    
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
       
        ]);
    

        $car = Car::find($request->car_id);
        $dateDifference = strtotime($request->tanggal_akhir) - strtotime($request->tanggal_mulai);
        $total = ($dateDifference / (60 * 60 * 24)) * $car->tarif_per_hari;
    
        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'car_id' => $request->car_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'total' => $total,
            'status' => 'terbooking',
        ]);
    
        return redirect()->route('home');
    }
}
