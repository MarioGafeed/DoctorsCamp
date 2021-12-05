<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
          $table->engine = 'InnoDB';
            // $table->increments('id');
            $table->id();
            // $table->ipAddress('visitor');
            $table->string('name');                        
            $table->string('phone')->nullable(); // For mobile Phone
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type', ['user', 'admin'])->default('user');
            $table->boolean('active')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
