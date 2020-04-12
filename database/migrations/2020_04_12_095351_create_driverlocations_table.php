<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverlocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driverlocations', function (Blueprint $table) {
            $table->bigIncrements('DLid');
            $table->string('d_latitude');
            $table->string('d_longitude');
            $table->string('isOnline')->nullable();
            $table->unsignedBigInteger('U_id')->nullable();
            $table->foreign('U_id')->references('id')->on('users');
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
        Schema::dropIfExists('driverlocations');
    }
}
