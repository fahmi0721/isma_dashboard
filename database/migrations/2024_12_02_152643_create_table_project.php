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
        Schema::create('tb_project', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("entitas_id")->index();
            $table->bigInteger("kategori_id")->index();
            $table->string("kode",50)->unique()->index();
            $table->string("nama",100);
            $table->string("deskripsi",100);
            $table->date("valid_from");
            $table->date("valid_to");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_project');
    }
};
