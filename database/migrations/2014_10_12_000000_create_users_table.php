<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('handler')->unique()->index(); // The User's @
            $table->string('email')->unique();
            $table->string('display'); // The display name, changeable
            $table->string('password');
            $table->float('exp')->default(0.00); // Experience, 8 digits in total, 2 digits after period
            $table->float('cor')->default(0.00); // Corruption, 8 digits in total, 2 digits after period
            $table->rememberToken();
            $table->timestamps();
        });
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
