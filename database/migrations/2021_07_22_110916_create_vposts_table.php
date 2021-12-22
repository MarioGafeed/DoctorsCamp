<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::disableForeignKeyConstraints(); // For Forgen Key Checks Disable
        Schema::create('vposts', function (Blueprint $table) {
          $table->engine = 'InnoDB';            
            $table->bigIncrements();
            $table->text('title');
            $table->longtext('content');
            $table->longtext('desc');
            $table->text('keyword');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('vcat_id')->constrained('vcategories');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
      Schema::enableForeignKeyConstraints(); // For Forgen Key Checks Enable
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vposts');
    }
}
