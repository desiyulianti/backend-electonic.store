<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{

    protected $table = 'customers';
    public $timestamps = false;
    protected $fillable = ['id_customer', 'nama', 'alamat', 'telp', 'username', 'password'];
    use HasFactory;
}
