<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('shop_id');
            $table->string('name');
            $table->float('price');
            $table->float('discount_price')->nullable();
            $table->text('link')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('id_from_shop')->nullable();
            $table->text('description')->nullable();
            $table->string('delivery_cost_riga')->nullable();
            $table->string('delivery_latvija')->nullable();
            $table->string('delivery_circlek')->nullable();
            $table->integer('delivery_days_riga')->nullable();
            $table->integer('delivery_days_latvija')->nullable();
            $table->string('category')->nullable();
            $table->string('category_full')->nullable();
            $table->string('category_link')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->integer('guarantee_months')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('in_stock')->nullable();
            $table->boolean('delivery_latvijas_pasts')->default(false);
            $table->boolean('delivery_dpd_paku_bode')->default(false);
            $table->boolean('delivery_pasta_stacija')->default(false);
            $table->boolean('delivery_omniva')->default(false);
            $table->boolean('used')->default(false);
            $table->boolean('with_gift')->default(false);
            $table->boolean('is_top')->default(false);
            $table->boolean('is_example')->default(false);
            $table->boolean('is_bestseller')->default(false);

            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
