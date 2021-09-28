<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->foreignId('user_id')->comment('the person who sold the item')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->boolean('is_sold');
            $table->integer('org_price')->comment('original price of the product');
            $table->integer('sold_price')->comment('price of the product when sold');
            $table->integer('total_price')->comment('price of the product when sold');
            $table->integer('quantity');
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
}
