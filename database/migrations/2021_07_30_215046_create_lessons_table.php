<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('title');
          $table->longtext('content');
          $table->longtext('vcontent');
          $table->integer('myorder');
          $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')->onDelete('cascade');
          $table->boolean('active')->default(true);
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
        Schema::dropIfExists('lessons');
    }
}
