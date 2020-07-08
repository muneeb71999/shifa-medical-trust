<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CustomeMigration extends Migration
{

    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        Schema::table('token_numbers', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        Schema::table('sales', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('medicine_id')->references('id')->on('medicines');
            $table->foreign('invoice_id')->references('id')->on('sale_invoices');
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('doctor_id')->references('id')->on('employees');
        });
    }
}
