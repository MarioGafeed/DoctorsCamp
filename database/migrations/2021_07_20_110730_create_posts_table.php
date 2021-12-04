<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatepostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::disableForeignKeyConstraints();
        Schema::create('posts', function (Blueprint $table) {
          $table->engine = 'InnoDB';
            // $table->increments('id');
            $table->id();
            $table->text('title');          
            $table->longtext('content');
            $table->text('desc');
            $table->text('keyword');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('pcat_id')->constrained('pcategories');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
