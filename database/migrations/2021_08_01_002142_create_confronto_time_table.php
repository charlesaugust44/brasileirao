<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfrontoTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confronto_time', function (Blueprint $table) {
            $table->foreignId('time_id')->references('id')->on('times');
            $table->foreignId('confronto_id')->references('id')->on('confrontos');
            $table->boolean('casa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confronto_time');
    }
}
