<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->uuid('borrowing_request_id')
                ->nullable();
            $table->uuid('user_id')
                ->nullable();
            $table->uuid('room_id')
                ->nullable();
            $table->uuid('computer_id')
                ->nullable();
            $table->string('description');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('borrowing_request_id')
                ->references('id')
                ->on('borrowing_requests')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('computer_id')
                ->references('id')
                ->on('computers')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
