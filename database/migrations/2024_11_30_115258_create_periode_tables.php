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
        Schema::create('tb_periode', function (Blueprint $table) {
            $table->id();
            $table->string("nama",15)->unique()->index();
            $table->string("keterangan",100);
            $table->enum("status", array("0","1"))->default("0");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_periode');
    }
};
