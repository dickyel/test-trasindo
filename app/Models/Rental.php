<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = ['nama_toko', 'alamat', 'nomor_toko', 'user_id'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
