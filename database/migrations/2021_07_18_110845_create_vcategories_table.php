<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vcategories', function (Blueprint $table) {
          $table->engine = 'InnoDB';
            // $table->increments('id');
            $table->id();
            $table->text('title');
            $table->string('image')->nullable();
            $table->longtext('summary');
            $table->text('keyword');
            $table->longtext('desc');
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
        Schema::dropIfExists('vcategories');
    }
}
