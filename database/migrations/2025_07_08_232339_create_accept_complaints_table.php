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
        Schema::create('accept_complaints', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('description')->nullable();
            $table->timestamp('doned_at')->nullable();
            $table->text('attachment')->nullable();
            $table->foreignUuid('complaint_id')->constrained('complaints');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accept_complaints');
    }
};
