<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semua_log', function (Blueprint $table) {
            $table->string('id')->primary();           // ID dari log Mikrotik
            $table->string('time', 20)->nullable();    // Waktu log
            $table->string('topics')->nullable();      // Topik log (pppoe, system, dll)
            $table->text('message')->nullable();       // Pesan log
            $table->timestamps();                      // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('semua_log');
    }
};
