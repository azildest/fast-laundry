<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faq', function (Blueprint $table) {
            $table->enum('status', ['in_progress', 'approved', 'blocked'])->default('in_progress')->after('jawaban');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faq', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
