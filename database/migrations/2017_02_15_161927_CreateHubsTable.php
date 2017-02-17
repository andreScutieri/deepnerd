<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->index();
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->boolean('visible')->default(True);
            $table->boolean('nsfw')->default(False);
            $table->boolean('dice')->default(False);
            $table->boolean('official')->default(False);
            $table->timestamps();
        });

        Schema::create('hub_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hub_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
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
        Schema::dropIfExists('hubs');
        Schema::dropIfExists('hub_user');
    }
}
