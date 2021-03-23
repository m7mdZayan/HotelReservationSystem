<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('client_id');///foriegn key to the client table  
            $table->foreign('client_id')->nullable()
            ->references('id')->on('users')
            ->onDelete('cascade');

            $table->unsignedInteger('room_id');///foriegn key to the client table  
            $table->foreign('room_id')->nullable()
            ->references('id')->on('rooms')
            ->onDelete('cascade');

            $table->integer('accompany_number');
            $table->integer('paid_price');
            
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
        Schema::dropIfExists('reservations');
    }
}
