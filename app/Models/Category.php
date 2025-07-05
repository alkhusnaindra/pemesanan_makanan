<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu; // Tambahkan ini jika belum

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
