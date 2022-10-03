<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_orders extends Model
{

    protected $table = 'detail_order';
    public $timestamps = false;
    protected $fillable = ['id_detail_order', 'id_order', 'id_product', 'qty', 'subtotal'];
    use HasFactory;
}
