<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->string('title', 255);
            $table->integer('category_id');
            $table->text('details');
            $table->string('price', 9);
            $table->string('price_offer', 9);
            $table->string('offer_type', 50);
           // $table->integer('status', 1);
            $table->timestamps();
            $table->softDeletes();
            //$table->foreign('category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
