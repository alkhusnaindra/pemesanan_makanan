<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillable = ['meja_id', 'status', 'total_harga', 'catatan', 'bukti_pembayaran', 'status_pembayaran', 'order_id', 'snap_token', 'metode_pembayaran'];

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function details()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
