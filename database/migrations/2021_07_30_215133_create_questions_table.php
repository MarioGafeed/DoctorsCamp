<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('q_order');
            $table->longText('desc');
            $table->foreignId('lesson_id')->constrained('lessons')->onUpdate('cascade')->onDelete('cascade');
            $table->string('op1');
            $table->string('op2');
            $table->string('op3');
            $table->string('op4');
            $table->tinyInteger('right_ans');
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
        Schema::dropIfExists('questions');
    }
}
