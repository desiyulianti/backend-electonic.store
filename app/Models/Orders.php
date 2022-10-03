<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $table = 'orders';
    public $timestamps = false;
    protected $primaryKey = "id_order";
    protected $fillable = ['id_order', 'id_customer', 'tgl_order', 'subtotal'];
    use HasFactory;
}
