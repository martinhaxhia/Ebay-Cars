<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {

            $table->id();
            $table ->unsignedBigInteger('car_id')->nullable();
            $table ->foreign('car_id') -> references('id') -> on('cars') -> onDelete('cascade');
            $table ->unsignedBigInteger('user_id') -> nullable();
            $table ->foreign('user_id')-> references('id')->on('users') ->onDelete('cascade');
            $table->string('name');
            $table->string('hash_name');
            $table->string('mimes');
            $table->string('path');
            $table->softDeletes();
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
        Schema::dropIfExists('media');
    }
}
