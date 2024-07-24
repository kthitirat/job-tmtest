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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->text('name_th')->nullable();
            $table->text('name_en')->nullable();
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->string('unit')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->unsignedBigInteger('view')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
