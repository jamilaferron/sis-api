<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serviceuser_id');
            $table->foreign('serviceuser_id')->references('id')->on('service_users');
            $table->integer('supportworker_id');
            $table->foreign('supportworker_id')->references('id')->on('support_workers');
            $table->string('session_type');
            $table->foreign('session_type')->references('service_type')->on('service_types');
            $table->integer('pickup_address');
            $table->foreign('pickup_address')->references('id')->on('addresses');
            $table->integer('dropoff_address');
            $table->foreign('dropoff_address')->references('id')->on('addresses');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('hours');
            $table->decimal('session_budget','13', '2');
            $table->integer('request_id');
            $table->foreign('request_id')->references('id')->on('support_requests');
            $table->timestamp('actual_start_time')->nullable();
            $table->timestamp('actual_end_time')->nullable();
            $table->boolean('cancelled')->default(0);
            $table->boolean('late_cancellation')->default(0);
            $table->timestamp('cancellation_time')->nullable();
            $table->boolean('report_submission')->default(0);
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
        Schema::dropIfExists('support_sessions');
    }
}
