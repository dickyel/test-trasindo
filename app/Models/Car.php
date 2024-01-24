<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['merek', 'model', 'plat_no', 'tarif_per_hari', 'rental_id'];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'car_id');
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function galleries()
    {
        return $this->hasMany(
            Gallery::class, 'car_id','id'
        );
    }
}
