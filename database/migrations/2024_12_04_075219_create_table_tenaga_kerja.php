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
        Schema::create('tb_tenaga_kerja', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("project_id")->index();
            $table->bigInteger("periode_id")->index();
            $table->bigInteger("job_id")->index();
            $table->bigInteger("job_type_id")->index();
            $table->integer("jumlah_tk");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tenaga_kerja');
    }
};
