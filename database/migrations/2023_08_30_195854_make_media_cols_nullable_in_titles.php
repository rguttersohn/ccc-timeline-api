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
        Schema::table('titles', function (Blueprint $table) {
            $table->text('media')->nullable()->change();
            $table->text('caption')->nullable()->change();
            $table->text('credit')->nullable()->change();
            $table->text('headline')->nullable()->change();
            $table->text('text')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('titles', function (Blueprint $table) {
            $table->text('media')->change();
            $table->text('caption')->change();
            $table->text('credit')->change();
            $table->text('headline')->change();
            $table->text('text')->change();
        });
    }
};
