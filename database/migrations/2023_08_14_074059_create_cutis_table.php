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
        Schema::create('cutis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('who')->nullable();
            $table->foreignId('whoAcc')->nullable();
            $table->enum('perihal', ['Kurang Fit', 'Sakit', 'Acara Keluarga', 'Acara Lainnya', 'Lainnya'])->default('Lainnya');
            $table->text('total')->nullable();
            $table->timestamp('tglCuti')->nullable();
            $table->timestamp('tglAcc')->nullable();
            $table->enum('status', [0, 1, 2])->default(0);
            $table->text('rincian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cutis');
    }
};
