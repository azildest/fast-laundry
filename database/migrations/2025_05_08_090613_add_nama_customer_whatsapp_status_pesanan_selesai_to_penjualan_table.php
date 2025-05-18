<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaCustomerWhatsappStatusPesananSelesaiToPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->string('nama_customer')->nullable();
            $table->string('whatsapp', 15)->nullable();
            $table->string('status')->default('belum selesai');
            $table->date('pesanan_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn(['nama_customer', 'whatsapp', 'status', 'pesanan_selesai']);
        });
    }
}
