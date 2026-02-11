<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'nomor_pelanggan',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
