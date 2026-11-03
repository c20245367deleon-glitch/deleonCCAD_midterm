<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phlebotomists', function (Blueprint $table) {
            $table->id();
            $table->string('phlebotomist_name', 150)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phlebotomists');
    }
};