<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'meja_id',  // tambahkan ini supaya bisa mass assign
    ];

    // Relasi ke model Meja
    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
}
