<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('su_name');
            $table->date('dob');
            $table->json('needs');
            $table->mediumText('background_Info');
            $table->integer('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->integer('socialworker_id');
            $table->foreign('socialworker_id')->references('id')->on('social_workers');
            $table->integer('placementOfficer_id');
            $table->foreign('placementOfficer_id')->references('id')->on('social_workers')->nullable();
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
        Schema::dropIfExists('service_users');
    }
}
