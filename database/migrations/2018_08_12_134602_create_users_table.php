<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->date('dob');
            $table->string('gender');
            $table->foreign('gender')->references('gender')->on('genders');
            $table->integer('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->string('dbs_num',15)->unique()->nullable();
            $table->string('profile_image')->nullable();
            $table->string('role');
            $table->foreign('role')->references('role')->on('roles');
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('verified')->default(false);
        });
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
