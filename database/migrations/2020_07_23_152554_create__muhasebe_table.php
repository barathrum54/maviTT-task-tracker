<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuhasebeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muhasebe', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('BA')->nullable();
            $table->integer('musteri_id');
            $table->bigInteger('tutar');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('muhasebe');
    }
}