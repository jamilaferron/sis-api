<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('contract_type');
            $table->foreign('contract_type')->references('contract_type')->on('contract_types');
            $table->json('availability');
            $table->json('specialities');
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
        Schema::dropIfExists('support_workers');
    }
}
