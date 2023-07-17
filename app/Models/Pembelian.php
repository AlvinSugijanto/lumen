<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Pembelian extends Model
{
    
    protected $table = 'pembelian';

    protected $primaryKey = 'id_pembelian';

    protected $fillable = [
        
        'total_harga', 
        'status',
        
    ];

    public function detail_pembelian()
    {
        return $this->hasMany(App\Models\DetailPembelian::class, 'pembelian_id', 'id_pembelian' );
    }
    public function createPembelian($items)
    {
        $response_items = [];
        $total_harga = 0;
    
        return DB::transaction(function () use ($items, &$response_items, &$total_harga) {

            $pembelian = $this->create([
                'status' => 'aktif',
                'total_harga' => 0
            ]);
    
            foreach ($items as $item) {

                $subtotal = (new Product())->getHarga($item['product_id']) * $item['qty'];
    
                $product = Product::find($item['product_id']);
    
                // Increment product_qty
                $product->product_qty += $item['qty'];
                $product->save();
    
                $response_items[] = DetailPembelian::create([
                    'qty' => $item['qty'],
                    'subtotal' => $subtotal,
                    'product_id' => $item['product_id'],
                    'pembelian_id' => $pembelian->id_pembelian
                ]);
    
                $total_harga += $subtotal;
            }
    
            $pembelian->update([
                'total_harga' => $total_harga
            ]);
    
            return $response_items;
        });
    }
    public function editPembelian($id, $data)
    {
        $penjualan = $this->find($id);

        if(!$penjualan)
        {
            throw new Exception('Penjualan Not Found');
        }

        $penjualan->update($data);

        return $penjualan;
    }
    public function deletePembelian($id)
    {

        $pembelian = $this->find($id);

        if (!$pembelian) {
            throw new Exception('Pembelian Not Found');
        }

        $pembelian->update([
            'status' => 'tidak_aktif'
        ]);
        
        return true;

    }
}