<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

use App\Models\DetailPenjualan;
use App\Models\Product;

class Penjualan extends Model
{
    
    protected $table = 'penjualan';

    protected $primaryKey = 'id_penjualan';
   
    protected $fillable = [
        'total_harga', 
        'status',
    ];

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id', 'id_penjualan' );
    }

    public function createPenjualan($items)
    {
        $response_items = [];
        $total_harga = 0;
    
        return DB::transaction(function () use ($items, &$response_items, &$total_harga) {
            $penjualan = $this->create([
                'status' => 'aktif',
                'total_harga' => 0
            ]);
    
            foreach ($items as $item) {

                $subtotal = (new Product())->getHarga($item['product_id']) * $item['qty'];
    
                // Check if product quantity is sufficient
                $product = Product::find($item['product_id']);
                if ($product->product_qty < $item['qty']) {
                    throw new Exception('Insufficient product quantity');
                }
    
                // Decrement product_qty
                $product->product_qty -= $item['qty'];
                $product->save();
    
                $response_items[] = DetailPenjualan::create([
                    'qty' => $item['qty'],
                    'subtotal' => $subtotal,
                    'product_id' => $item['product_id'],
                    'penjualan_id' => $penjualan->id_penjualan
                ]);
    
                $total_harga += $subtotal;
            }
    
            $penjualan->update([
                'total_harga' => $total_harga
            ]);
    
            return $response_items;
        });
    }

    public function editPenjualan($id, $data)
    {
        $penjualan = $this->find($id);

        if(!$penjualan)
        {
            throw new Exception('Penjualan Not Found');
        }

        $penjualan->update($data);

        return $penjualan;
    }

    public function deletePenjualan($id)
    {

        $penjualan = $this->find($id);

        if (!$penjualan) {
            throw new Exception('Penjualan Not Found');
        }

        $penjualan->update([
            'status' => 'tidak_aktif'
        ]);
        
        return true;

    }
}