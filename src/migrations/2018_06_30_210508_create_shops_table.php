<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('logo')->nullable();
            $table->string('name');
            $table->string('reg_number');
            $table->string('email');
            $table->string('second_email')->nullable();
            $table->string('phone');
            $table->string('second_phone')->nullable();
            $table->string('manager_phone')->nullable();
            $table->string('address');
            $table->string('xml')->nullable();
            $table->timestamp('xml_updated_at')->nullable();
            $table->string('slug');
            $table->boolean('sandbox')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('shops');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
