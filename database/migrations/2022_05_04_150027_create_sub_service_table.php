<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_service', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            // service
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('service')->onDelete('cascade');
             // price nullable
            $table->decimal('price', 10, 2)->nullable();
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
        Schema::dropIfExists('sub_service');
    }
}
