<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowing_requests', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->uuid('user_id')
                ->nullable();
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->text('reason');
            $table->enum('status', ['Accept', 'Reject'])
                ->nullable();
            $table->text('rejection_reason')
                ->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('borrowing_requests');
    }
}
