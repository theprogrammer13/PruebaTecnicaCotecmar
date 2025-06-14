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
        Schema::create('parts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->decimal('theoretical_weight', 8, 2);
            $table->decimal('real_weight', 8, 2)->nullable();
            $table->enum('status', ['Pendiente', 'Fabricado'])->default('Pendiente');
            $table->string('block_id');
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->dateTime('registration_date')->nullable();
            $table->unsignedBigInteger('registered_by')->nullable();
            $table->foreign('registered_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
