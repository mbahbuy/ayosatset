<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_hash');
            $table->string('shop_hash');
            $table->string('product_hash');
            $table->string('order_hash')->unique();
            $table->string('code');
            $table->bigInteger('pcs');
            $table->bigInteger('payment');
            $table->bigInteger('status');
            $table->string('img_payment')->nullable();
            $table->string('no_resi')->nullable();
            $table->string('img_kurir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
