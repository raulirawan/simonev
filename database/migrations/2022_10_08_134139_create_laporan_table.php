<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('karyawan_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_laporan')->nullable();
            $table->longText('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->string('kelurahan_asal')->nullable();
            $table->string('skpd')->nullable();
            $table->dateTime('tanggal_laporan')->nullable();
            $table->dateTime('tanggal_status_terakhir')->nullable();
            $table->longText('catatan')->nullable();
            $table->boolean('status')->default(0)->comment('0 unprocess, 1 process');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan');
    }
}
