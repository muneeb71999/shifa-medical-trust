<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
        });



        DB::table('users')->insert([
            'employee_id' => 1,
            'name' => "Mubeen Akram",
            'username' => "admin",
            'is_admin' => true,
            'password' => Hash::make('smt786'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
