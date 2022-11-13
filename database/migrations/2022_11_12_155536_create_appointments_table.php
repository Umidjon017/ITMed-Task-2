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
            $table->enum('identifier_use', ['usual', 'official', 'temp', 'secondary', 'old'])->nullable();
            $table->enum('identifier_type', ['DL', 'PPN', 'TPPN', 'NNUZB', 'REO', 'TAX', 'CZ', 'BCT', 'RI'])->nullable();
            $table->string('identifier_system')->nullable();
            $table->string('identifier_value')->nullable();
            $table->string('identifier_start')->nullable();
            $table->string('identifier_end')->nullable();
            $table->string('identifier_assigner')->nullable();
            $table->enum('status', [
                'proposed', 'pending', 'booked', 'arrived', 'fulfilled', 'cancelled', 'noshow','entered-in-error', 'checked-in', 'waitlist'
            ])->default('booked');
            $table->string('participant_1');
            $table->string('participant_2');
            $table->string('performer');
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
