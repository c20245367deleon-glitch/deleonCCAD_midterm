<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donor_id')
                ->constrained('donors')
                ->onDelete('restrict');

            $table->foreignId('campaign_id')
                ->constrained('campaigns')
                ->onDelete('restrict');

            $table->foreignId('phlebotomist_id')
                ->constrained('phlebotomists')
                ->onDelete('restrict');

            $table->decimal('hemoglobin_level', 4, 1);
            $table->string('blood_pressure', 20);
            $table->unsignedInteger('volume_ml')->nullable();
            $table->string('screening_status', 20)->default('pending');
            $table->string('bag_serial', 40)->unique();

            $table->timestamps();

            $table->index(['campaign_id', 'created_at']);
            $table->index('screening_status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_logs');
    }
};