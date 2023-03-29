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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('user_hash')->nullable();
            $table->string('shop_hash')->nullable();
            $table->integer('province_id');
            $table->integer('city_id');
            $table->text('address');
            $table->string('phone');
            $table->tinyInteger('status')->default(true);
            $table->tinyInteger('use')->default(false);
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
        Schema::dropIfExists('addresses');
    }
};
