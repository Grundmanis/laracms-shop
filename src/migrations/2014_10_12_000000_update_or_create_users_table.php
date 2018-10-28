<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrCreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if(!Schema::hasColumn('users', 'avatar')) {
                    $table->string('avatar')->nullable();
                }
                if(!Schema::hasColumn('users', 'first_name')) {
                    $table->string('first_name')->nullable();
                }
                if(!Schema::hasColumn('users', 'last_name')) {
                    $table->string('last_name')->nullable();
                }
                if(!Schema::hasColumn('users', 'phone')) {
                    $table->string('phone')->nullable();
                }
                if(!Schema::hasColumn('users', 'address')) {
                    $table->string('address')->nullable();
                }

                if(!Schema::hasColumn('users', 'seller')) {
                    $table->boolean('seller')->default(false);
                }
            });
        } else {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password')->nullable();

                $table->string('avatar')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('phone')->nullable();
                $table->string('address')->nullable();
                $table->boolean('seller')->default(false);

                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
//        Schema::dropIfExists('users');
//        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
