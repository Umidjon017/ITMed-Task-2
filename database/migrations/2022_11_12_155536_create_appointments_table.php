<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status', [
                'proposed', 'pending', 'booked', 'arrived', 'fulfilled', 'cancelled', 'noshow','entered-in-error', 'checked-in', 'waitlist'
            ])->default('booked');
            $table->uuid('participant_1')->nullable();
            $table->uuid('participant_2')->nullable();
            $table->uuid('performer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
