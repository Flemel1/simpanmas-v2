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
        Schema::create('complaints', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100);
            $table->string('title', 200);
            $table->text('description');
            $table->string('report_category', 100);
            $table->string('phone_number', 12);
            $table->foreignUuid('agency_id')->constrained('agencies');
            $table->text('identity_photo');
            $table->text('attachment')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
