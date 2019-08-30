<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('gift_link')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('manufacturer_code')->nullable();
            $table->string('manufacturer_link')->nullable();
            $table->string('description_ru')->nullable();
            $table->string('link_ru')->nullable();
            $table->string('category_full_ru')->nullable();
            $table->string('return_term')->nullable();
            $table->string('insurance_term')->nullable();
            $table->string('additional_warranty_term')->nullable();
            $table->string('additional_warranty_cost')->nullable();
            $table->string('insurance_cost')->nullable();
            $table->string('credit_free')->nullable();
            $table->string('credit_free_term')->nullable();
            $table->string('credit_pay_3')->nullable();
            $table->string('credit_pay_6')->nullable();
            $table->string('credit_pay_12')->nullable();
            $table->string('credit_pay_24')->nullable();
            $table->string('credit_pay_36')->nullable();
            $table->string('credit_pay_x')->nullable();
            $table->string('credit_pay_x_term')->nullable();
            $table->string('delivery_office')->nullable();
            $table->string('delivery_days_office')->nullable();
            $table->string('delivery_days_latvijas_pasts')->nullable();
            $table->string('delivery_pakomats')->nullable();
            $table->string('delivery_days_pakomats')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('gift_link');
            $table->dropColumn('name_ru');
            $table->dropColumn('manufacturer_code');
            $table->dropColumn('manufacturer_link');
            $table->dropColumn('description_ru');
            $table->dropColumn('link_ru');
            $table->dropColumn('category_full_ru');
            $table->dropColumn('return_term');
            $table->dropColumn('insurance_term');
            $table->dropColumn('additional_warranty_term');
            $table->dropColumn('additional_warranty_cost');
            $table->dropColumn('insurance_cost');
            $table->dropColumn('credit_free');
            $table->dropColumn('credit_free_term');
            $table->dropColumn('credit_pay_3');
            $table->dropColumn('credit_pay_6');
            $table->dropColumn('credit_pay_12');
            $table->dropColumn('credit_pay_24');
            $table->dropColumn('credit_pay_36');
            $table->dropColumn('credit_pay_x');
            $table->dropColumn('credit_pay_x_term');
            $table->dropColumn('delivery_office');
            $table->dropColumn('delivery_days_office');
            $table->dropColumn('delivery_days_latvijas_pasts');
            $table->dropColumn('delivery_pakomats');
            $table->dropColumn('delivery_days_pakomats');
        });
    }
}
