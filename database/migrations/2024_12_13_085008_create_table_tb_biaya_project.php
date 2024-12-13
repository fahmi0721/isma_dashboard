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
        Schema::create('tb_pb_project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("project_id")->index()->unique();
            $table->bigInteger("periode_id")->index()->unique();
            $table->bigInteger("biaya");
            $table->bigInteger("pendapatan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pb_project');
    }
};
