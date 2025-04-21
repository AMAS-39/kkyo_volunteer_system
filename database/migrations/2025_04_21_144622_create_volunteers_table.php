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
    Schema::create('volunteers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->unsignedInteger('user_code')->unique(); // like 205, 305
        $table->unsignedInteger('department_code');
        $table->integer('points')->default(0);
        $table->timestamps();

        // optional: foreign key constraint to departments
        // $table->foreign('department_code')->references('code')->on('departments');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
