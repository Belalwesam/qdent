<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
             // user id is the foreign key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
             // provider id is the foreign key
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('users');
            // rate
            // 1-5
            // 1 = bad
            // 5 = good
            // default = 0
            // if 0 then it is not rated
            // if 1 then it is rated
            // if 2 then it is rated
            // if 3 then it is rated
            //  if 4 then it is rated
            //  if 5 then it is rated
            $table->integer('rate')->default(0);
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
        Schema::dropIfExists('hrj_comment');
    }
}
