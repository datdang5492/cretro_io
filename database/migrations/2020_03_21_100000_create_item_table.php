<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->string('order_id');

            $table->boolean('status');  // active or cancelled
            $table->boolean('is_completed');  // completed or not

            $table->string('confirm_code');

            $table->float('weight');
            $table->float('total_price');
            $table->float('value');
            $table->float('currency');
            $table->date('expected_delivery');
            $table->date('flight_date');
            $table->string('from');
            $table->string('to');

            $table->string('shipment_id');
            $table->string('shipper_id');
            $table->string('user_id');


            $table->text('note');
            $table->dateTime('create_at');
            $table->dateTime('completed_at');

            $table->index('order_id');
            $table->primary('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
