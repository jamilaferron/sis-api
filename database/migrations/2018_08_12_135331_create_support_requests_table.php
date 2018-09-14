<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serviceuser_id');
            $table->foreign('serviceuser_id')->references('id')->on('service_users');
            $table->integer('request_hours');
            $table->decimal('activity_budget', '13', '2');
            $table->string('payment_reference');
            $table->date('start_date');
            $table->boolean('active')->default(1);
            $table->json('request_days');
            $table->string('service_type');
            $table->foreign('service_type')->references('service_type')->on('service_types');
            $table->decimal('invoicing_rate', '13', '2');
            $table->foreign('invoicing_rate')->references('invoicing_rate')->on('invoicing_rates');
            $table->decimal('employee_rate', '13', '2');
            $table->foreign('employee_rate')->references('employee_rate')->on('employee_rates');
            $table->string('support_level');
            $table->foreign('support_level')->references('level')->on('support_levels');
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
        Schema::dropIfExists('support_requests');
    }
}
