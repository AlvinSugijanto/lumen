<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->id();
            $table->integer('qty');
            $table->float('subtotal');
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('pembelian_id')->unsigned();

            $table->timestamps();

            $table->foreign('product_id')->references('id_product')->on('product');
            $table->foreign('pembelian_id')->references('id_pembelian')->on('pembelian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pembelian');
    }
}
