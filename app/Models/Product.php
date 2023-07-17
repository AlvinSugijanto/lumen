<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;


class Product extends Model
{
    protected $table = 'product';

    protected $primaryKey = 'id_product';

    protected $fillable = [

        'product_name',
        'product_category',
        'product_qty',
        'product_price',
        'product_status'

    ];

    public function createProduct($data)
    {
        return $this->create([
            'product_name' => $data['product_name'],
            'product_category' => $data['product_category'],
            'product_qty'   => 0,
            'product_price' => $data['product_price'],
            'product_status' => 'aktif'
        ]);
    }

    public function editProduct($id, $data)
    {
        $product = $this->find($id);

        if (!$product) {
            throw new Exception('Product Not Found');
        }

        $product->update($data);

        return $product;
    }
    public function deleteProduct($id)
    {

        $product = $this->find($id);

        if (!$product) {
            throw new Exception('Product Not Found');
        }

        $product->update([
            'product_status' => 'tidak_aktif'
        ]);
        
        return true;

    }

    public function getHarga($id)
    {
        return $this->where('id_product', $id)->first()->value('product_price');
    }
}
