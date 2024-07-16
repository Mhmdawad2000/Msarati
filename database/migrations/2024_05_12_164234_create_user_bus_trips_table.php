<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_bus_trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_passenger_id');
            $table->unsignedBigInteger('bus_trip_id');
            $table->foreign('user_passenger_id')->references('id')->on('users');
            $table->foreign('bus_trip_id')->references('id')->on('trips');
            $table->unique(['user_passenger_id', 'bus_trip_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_bus_trips');
    }
};