<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            [

                'product_name'     => 'Saos ABC',
                'product_category' => 'Saos',
                'product_qty'      => '0',
                'product_price'    => '10000',
                'product_status'   => 'aktif',
                'created_at'       => Carbon::now(),
            ],
            [
                'product_name'     => 'Kecap Bango',
                'product_category' => 'Kecap',
                'product_qty'      => '0',
                'product_price'    => '7000',
                'product_status'   => 'aktif',
                'created_at'       => Carbon::now()
            ],
            [
                'product_name'     => 'Wafer Tango',
                'product_category' => 'Snack',
                'product_qty'      => '0',
                'product_price'    => '15000',
                'product_status'   => 'aktif',
                'created_at'       => Carbon::now()
            ],
            [
                'product_name'     => 'Aqua Botol 600ml',
                'product_category' => 'Minuman',
                'product_qty'      => '0',
                'product_price'    => '6000',
                'product_status'   => 'aktif',
                'created_at'       => Carbon::now()
            ],
            [
                'product_name'     => 'Teh Javana',
                'product_category' => 'Minuman',
                'product_qty'      => '0',
                'product_price'    => '3000',
                'product_status'   => 'aktif',
                'created_at'       => Carbon::now()
            ]
        ]);
    }
}
