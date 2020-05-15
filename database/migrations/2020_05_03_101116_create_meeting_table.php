<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('conductor_id');
            $table->string('team_name');
            $table->string('sprint_name')->nullable();
            $table->integer('duration');
            $table->integer('attendee_no');
            $table->integer('max_vote');
            $table->boolean('status')->default(0);
            $table->dateTime('stopped_at', 0)->nullable();
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting');
    }
}
