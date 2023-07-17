<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DetailPembelian extends Model
{
    
    protected $table = 'detail_pembelian';

   
    protected $fillable = [
        'qty', 
        'subtotal',
        'product_id',
        'pembelian_id'
    ];
}