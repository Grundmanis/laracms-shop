<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_category_id')->nullable();

            $table->foreign('parent_category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('category_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['category_id','locale']);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_translations', function(Blueprint $table) {
            $table->dropForeign('category_translations_category_id_foreign');
        });
        Schema::table('categories', function(Blueprint $table) {
            $table->dropForeign('categories_parent_category_id_foreign');
        });
        Schema::dropIfExists('category_translations');
        Schema::dropIfExists('categories');
    }
}
