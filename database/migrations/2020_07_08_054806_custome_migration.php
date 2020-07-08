<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
        Schema::table('token_numbers', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->foreign('invoice_id')->references('id')->on('sale_invoices');
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('doctor_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
