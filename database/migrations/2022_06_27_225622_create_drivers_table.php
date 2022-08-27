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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id('driver_id');
            $table->foreignId('id')->references('id')->on('users');
            $table->date('birth_date')->nullable();
            $table->string('driving_license_num');
            $table->date('exp_date')->nullable();
            $table->boolean('working')->default(1);
            $table->boolean('available')->default(1);
            $table->double('lat')->default(0);
            $table->double('lon')->default(0);
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
        Schema::dropIfExists('drivers');
    }
};
