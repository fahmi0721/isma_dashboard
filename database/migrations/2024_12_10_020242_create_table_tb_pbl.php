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
        Schema::create('tb_pbl', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("periode_id")->index()->unique();
            $table->bigInteger("pendapatan");
            $table->bigInteger("biaya");
            $table->bigInteger("laba_rugi");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pbl');
    }
};
