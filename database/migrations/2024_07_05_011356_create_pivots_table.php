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
        Schema::create('pivots', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_peminjaman')->unsigned();
            $table->bigInteger('id_buku')->unsigned();
            $table->timestamps();

            $table->foreign('id_peminjaman')->references('id')->on('peminjamans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_buku')->references('id')->on('bukus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivots');
    }
};
