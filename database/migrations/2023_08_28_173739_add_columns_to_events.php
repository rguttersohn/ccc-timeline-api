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
        Schema::table('events', function (Blueprint $table) {
            $table->integer('year')->nullable();
            $table->integer('end_year')->nullable();
            $table->text('display_date')->nullable();
            $table->text('headline')->nullable();
            $table->text('text')->nullable();
            $table->text('media')->nullable();
            $table->text('media_credit')->nullable();
            $table->text('media_thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('year');
            $table->dropColumn('end_year');
            $table->dropColumn('display_date');
            $table->dropColumn('headline');
            $table->dropColumn('text');
            $table->dropColumn('media');
            $table->dropColumn('media_credit');
            $table->dropColumn('media_thumbnail');
        });
    }
};
