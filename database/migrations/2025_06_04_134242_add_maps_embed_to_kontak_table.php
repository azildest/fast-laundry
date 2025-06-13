<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMapsEmbedToKontakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::table('kontak', function (Blueprint $table) {
        $table->text('maps_embed')->nullable();
    });
}

public function down()
{
    Schema::table('kontak', function (Blueprint $table) {
        $table->dropColumn('maps_embed');
    });
}
}
