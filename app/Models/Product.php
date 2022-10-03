<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'product';
    public $timestamps = false;
    protected $fillable = ['id_product', 'nama_produk', 'deskripsi', 'harga', 'foto_produk'];
    use HasFactory;
}
