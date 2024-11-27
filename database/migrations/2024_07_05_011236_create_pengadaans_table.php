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
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_inventaris')->unsigned()->nullable();
            $table->string('judul');
            $table->string('pengarang')->nullable();
            $table->string('penerbit')->nullable();
            $table->string('kode_ddc')->nullable();
            $table->string('status');
            $table->text('deskripsi')->nullable();
            $table->bigInteger('eksemplar');
            $table->bigInteger('diterima')->nullable();
            $table->timestamps();

            $table->foreign('id_inventaris')->references('id')->on('inventaris')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaans');
    }
};
