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
        Schema::create('titles', function (Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->foreignId('publication_status_id')->nullable()->cascadeOnDelete()->constrained('publication_status');
            $table->text('media');
            $table->text('caption');
            $table->text('credit');
            $table->text('headline');
            $table->text('text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titles');
    }
};
