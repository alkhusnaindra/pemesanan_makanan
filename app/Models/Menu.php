<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'category_id',
        'harga',
        'deskripsi',
        'gambar',
        'status_menu',
    ];

    public function pesananDetails()
    {
        return $this->hasMany(PesananDetail::class);
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}



}

