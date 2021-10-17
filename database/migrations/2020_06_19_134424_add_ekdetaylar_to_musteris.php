<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEkdetaylarToMusteris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('musteris', function (Blueprint $table) {
           $table->text('tc')->nullable();
           $table->text('edevlet_sifresi')->nullable();
           $table->text('email')->nullable();
           $table->text('email_sifresi')->nullable();
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