<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->uuid('room_type_id')
                ->nullable();
            $table->string('number');
            $table->boolean("available")
                ->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('room_type_id')
                ->references('id')
                ->on('room_types')
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
        Schema::dropIfExists('rooms');
    }
}
