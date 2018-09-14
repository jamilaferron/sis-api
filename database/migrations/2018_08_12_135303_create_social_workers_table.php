<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sw_name');
            $table->string('email')->unique();
            $table->string('local_authority');
            $table->foreign('local_authority')->references('local_authority')->on('local_authorities');
            $table->string('team');
            $table->foreign('team')->references('team')->on('la_teams');
            $table->integer('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->timestampTz('created_at')->default(DB::raw('now()'));
            $table->timestampTz('updated_at')->default(DB::raw('now()'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_workers');
    }
}
