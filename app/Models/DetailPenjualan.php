<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DetailPenjualan extends Model
{
    
    protected $table = 'detail_penjualan';

   
    protected $fillable = [
        'qty', 
        'subtotal',
        'product_id',
        'penjualan_id'
    ];
}