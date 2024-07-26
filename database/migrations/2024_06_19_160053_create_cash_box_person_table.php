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
        Schema::create('cash_box_person', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreignId('order_service_id')->constrained('order_service')->cascadeOnDelete();
            $table->bigInteger('sum');
            $table->bigInteger('remains');
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_box_person');
    }
};
