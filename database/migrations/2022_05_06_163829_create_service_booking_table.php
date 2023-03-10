<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_booking', function (Blueprint $table) {
            $table->id();
            // service_id
            $table->unsignedBigInteger('service_id');                         
            $table->foreign('service_id')->references('id')->on('services');
            // booking_id
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings');
            // sub service_id
            $table->unsignedBigInteger('sub_service_id');
            $table->foreign('sub_service_id')->references('id')->on('sub_services');

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
        Schema::dropIfExists('service_booking');
    }
}
