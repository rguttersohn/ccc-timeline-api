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
       
        Schema::create('publication_status', function(Blueprint $table):void{
            $table->id();
            $table->text('name');
        });
        
        Schema::table('events', function(Blueprint $table):void{
            $table->dropForeign('status_id_foreign');
            $table->dropColumn('status_id');
        });

        Schema::table('events', function (Blueprint $table):void {
            $table->foreignId('publication_status_id')->nullable()->cascadeOnDelete()->constrained('publication_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_status');

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('status_id_foreign');
            $table->dropColumn('status_id');
        });
    }
};
