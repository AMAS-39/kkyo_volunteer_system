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
    Schema::create('point_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('volunteer_id');
        $table->integer('points'); // can be + or -
        $table->string('reason');
        $table->unsignedBigInteger('added_by'); // user_id of who added
        $table->timestamps();

        $table->foreign('volunteer_id')->references('id')->on('volunteers')->onDelete('cascade');
        $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_histories');
    }
};
