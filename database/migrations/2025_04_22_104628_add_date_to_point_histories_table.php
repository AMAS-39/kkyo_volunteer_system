<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('point_histories', function (Blueprint $table) {
        $table->date('date')->nullable(); // or ->timestamp('date') if you prefer time
    });
}

public function down()
{
    Schema::table('point_histories', function (Blueprint $table) {
        $table->dropColumn('date');
    });
}

};
