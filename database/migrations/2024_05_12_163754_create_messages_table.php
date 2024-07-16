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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_sender_id');
            $table->unsignedBigInteger('user_reciver_id');
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->foreign('user_sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_reciver_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
