<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingTable extends Migration
{

    const MEETING_STATUS_ACTIVE = 1;
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
            $table->string('code');
            $table->string('team_name');
            $table->string('sprint_name')->nullable();
            $table->float('duration')->nullable();
            $table->integer('attendee_no');
            $table->integer('max_vote');
            $table->boolean('status')->default(self::MEETING_STATUS_ACTIVE);
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
