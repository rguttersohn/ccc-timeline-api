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
        Schema::create('eras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('year')->nullable();
            $table->integer('end_year')->nullable();
            $table->text('headline')->nullable();
            $table->text('text')->nullable();
            $table->foreignId('publication_status_id')->nullable()->cascadeOnDelete()->constrained('publication_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eras');
    }
};
