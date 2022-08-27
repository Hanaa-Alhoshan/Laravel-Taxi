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
        Schema::create('cab_rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shift_id')->default(0);
            $table->foreignId('action_id')->default(0);
            $table->string('order_start_point');
            $table->string('order_end_point');
           // $table->string('gbs_start_point')->default(0);
           // $table->string('gbs_end_point')->default(0);
           
            $table->string('pay_type')->default('cash');
            //$table->date('start_time')->default(0);
            //$table->date('end_time')->default(0);
            $table->string('ride_status')->default("individual");
            $table->boolean('canceled')->default(1);
            $table->boolean('taken')->default(0);
            $table->boolean('finish')->default(0);
            $table->time('order_time');
            $table->string('price')->default('unknown');

            $table->double('latt');
            $table->double('lont');
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
        Schema::dropIfExists('cab_rides');
    }
};
