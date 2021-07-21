<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVpostsTaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vposts_taqs', function (Blueprint $table) {
          $table->engine = 'InnoDB';
            $table->id();
            // $table->increments('id');
            $table->foreignId('vpost_id')->constrained();
            $table->foreignId('vtaq_id')->constrained();
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
        Schema::dropIfExists('vposts_taqs');
    }
}
