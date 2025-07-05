<?php

namespace App\Models;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_meja', 'qr_code_url'];

    public function pesanans() 
    {
        return $this->hasMany(Pesanan::class);
    }

    public static function booted()
    {
        
        static::creating(function ($meja) {
            // $qrCode = new QrCode(url('/meja-'.$meja->nomor_meja));
            $qrCode = new QrCode('http://localhost:8000/meja-' . $meja->nomor_meja);

            $writer = new PngWriter();
        
            $result = $writer->write($qrCode);
        
            // Pastikan direktori sudah ada
            $folder = public_path('storage/qrcodes');
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }
        
            $filename = 'meja_' . uniqid() . '.png';
            $path = $folder . '/' . $filename;
        
            // Simpan file secara manual
            file_put_contents($path, $result->getString());
        
            // Set URL untuk disimpan ke database
            $meja->qr_code_url = asset('storage/qrcodes/' . $filename);
        });
    }

}
