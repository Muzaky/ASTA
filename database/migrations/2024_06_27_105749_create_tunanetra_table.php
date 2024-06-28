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
        Schema::create('tunanetra', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->integer('umur');
            $table->string('jenis_kelamin');
            $table->string('kecamatan');
            $table->string('alamat');
            $table->string('nama_wali');
            $table->string('nomor_wali');
            $table->string('email')->unique();;
            $table->string('no_hp');
            $table->string('nik')->unique();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tunanetra');
    }
};
