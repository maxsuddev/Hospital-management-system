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
        Schema::create('category_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->unsigned()->constrained('categories')->onDelete('cascade');
            $table->unsignedBigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('persons')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_doctor');
    }
};
