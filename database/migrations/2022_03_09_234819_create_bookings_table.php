<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->integer("quantity");
            $table->string('booking_type');
            $table->string('phone_number');
            $table->string('address');
            $table->string('status');
            $table->date('delivery_date')->nullable();
            $table->date('pickup_date')->nullable();

            $table->timestamps();
         // $table->foreign('user_id')->references('id')->on('users')->Delete('cascade');   


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
