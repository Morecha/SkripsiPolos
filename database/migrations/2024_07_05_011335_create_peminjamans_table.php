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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_anggota')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->enum('status', ['dipinjam','kembali']);
            $table->text('detail');
            $table->integer('lama_peminjaman');
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
        Schema::dropIfExists('peminjamen');
    }
};
