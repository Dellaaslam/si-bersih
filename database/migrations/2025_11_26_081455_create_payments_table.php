<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('method'); // transfer bank, qris, dll
            $table->string('account_number')->nullable(); // no rekening
            $table->integer('amount'); // nominal
            $table->string('proof')->nullable(); // file bukti pembayaran
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
