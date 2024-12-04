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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_inven')->unsigned();
            $table->string('kode_buku');
            $table->text('keterangan')->nullable();
            $table->enum('posisi', ['dipinjam','ada','kelas','dimusnahkan','hilang']);
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('id_inven')->references('id')->on('inventaris')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
