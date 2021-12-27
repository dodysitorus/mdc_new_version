<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien_members', function (Blueprint $table) {
            $table->id();
            $table->string("status_pasien");
            $table->string('nama');
            $table->string('tanggal_lahir');
            $table->string('usia');
            $table->string('telephone');
            $table->string('cabang');
            $table->string('admin');
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
        Schema::dropIfExists('pasien_members');
    }
}
