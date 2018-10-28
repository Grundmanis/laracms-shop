<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaracmsShopFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laracms_shop_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('not_editable')->default(false);
        });

        Schema::create('laracms_shop_field_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->integer('shop_id')->unsigned();
            $table->integer('laracms_shop_field')->unsigned();
            $table->timestamps();
        });

        Schema::create('laracms_shop_field_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('shop_field_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['shop_field_id','locale'], 'field_id_locale');
            $table->foreign('shop_field_id', 'field_id_foreign')->references('id')->on('laracms_shop_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laracms_shop_field_translations');
        Schema::dropIfExists('laracms_shop_field_values');
        Schema::dropIfExists('laracms_shop_fields');
    }
}
