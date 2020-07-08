<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->float('unit_price');
            $table->integer('quantity');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('medicine_id')->references('id')->on('medicines');
            // $table->foreign('invoice_id')->references('id')->on('sale_invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
