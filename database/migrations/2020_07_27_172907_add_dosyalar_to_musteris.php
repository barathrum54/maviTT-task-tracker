<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDosyalarToMusteris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('musteris', function (Blueprint $table) {
          $table->text('f1')->nullable();
          $table->text('f2')->nullable();
          $table->text('f3')->nullable();
          $table->text('f4')->nullable();
          $table->text('f5')->nullable();
          $table->text('f6')->nullable();
          $table->text('f7')->nullable();
          $table->text('f8')->nullable();
          $table->text('f9')->nullable();
          $table->text('f10')->nullable();
          $table->text('f11')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('musteris', function (Blueprint $table) {
            //
        });
    }
}