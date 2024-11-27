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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->enum('status_presensi', ['individu', 'kelompok']);
            $table->bigInteger('id_anggota')->unsigned()->nullable();
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->bigInteger('jumlah'); //buat kelompok
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('id_anggota')->references('id')->on('anggotas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
