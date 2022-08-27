<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->string('img_url');

            $table->string('car_type')->default('car');
            $table->string('model_name')->default('model');
            $table->date('manufactor_year')->default(now());
            $table->string('technical_condition')->default('good');
            $table->string('price')->default('zero');
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
        Schema::dropIfExists('rental_cars');
    }
};
