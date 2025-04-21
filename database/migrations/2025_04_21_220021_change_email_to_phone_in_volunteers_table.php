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
    Schema::table('volunteers', function (Blueprint $table) {
        $table->dropColumn('email');
        $table->string('phone', 50)->unique(); // Use 50 or more if needed
    });
}

public function down(): void
{
    Schema::table('volunteers', function (Blueprint $table) {
        $table->dropColumn('phone');
        $table->string('email')->after('name');
    });
}

};
