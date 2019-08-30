<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('city')->nullable();
            $table->string('birthday')->nullable();
            $table->string('nameday')->nullable();
            $table->string('payment')->nullable();
            $table->string('delivery')->nullable();
            $table->string('full_name')->nullable();

            $table->string('company')->nullable();
            $table->string('reg_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('legal_address')->nullable();
            $table->string('company_city')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('city');
            $table->dropColumn('birthday');
            $table->dropColumn('nameday');
            $table->dropColumn('delivery');
            $table->dropColumn('payment');
            $table->dropColumn('full_name');
        });
    }
}
