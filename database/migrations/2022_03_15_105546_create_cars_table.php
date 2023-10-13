<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cars'))
        Schema::create('cars', function (Blueprint $table){
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->text('registration_date');
            $table->string('engine_size');
            $table->double('price');
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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_car_id_foreign');
        });
        Schema::dropIfExists('cars');
    }
}

