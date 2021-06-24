<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterStatusInBorrowingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('borrowing_requests', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });

        Schema::table('borrowing_requests', function (Blueprint $table) {
            $table->enum('status', ['Approved', 'Rejected', 'Waiting for Approval'])
                ->default('Waiting for Approval')
                ->after('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('borrowing_requests', function (Blueprint $table) {
            $table->dropColumn(['status']);
        });

        Schema::table('borrowing_requests', function (Blueprint $table) {
            $table->enum('status', ['Accept', 'Reject'])
                ->nullable()
                ->after('reason');
        });
    }
}
