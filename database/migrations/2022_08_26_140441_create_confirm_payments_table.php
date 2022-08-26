<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfirmPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirm_payments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nominal')->nullable();
            $table->string('bank_asal')->nullable();
            $table->string('bank_tujuan')->nullable();
            $table->string('bank_nama_rekening')->nullable();
            $table->string('bank_bukti_transfer')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('confirm_payments');
    }
}
