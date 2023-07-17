<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id();
            $table->integer('qty');
            $table->float('subtotal');
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('penjualan_id')->unsigned();
            

            $table->timestamps();

            $table->foreign('product_id')->references('id_product')->on('product');
            $table->foreign('penjualan_id')->references('id_penjualan')->on('penjualan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualan');
    }
}
