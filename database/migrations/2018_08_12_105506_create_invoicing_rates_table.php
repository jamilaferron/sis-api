<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicingRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoicing_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('invoicing_rate', 13, 2)->unique();
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
        Schema::dropIfExists('invoicing_rates');
    }
}
