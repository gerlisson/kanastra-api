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
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('historico_id')->references('id')->on('historicos');;

            $table->string('name');
            $table->string('governmentId');
            $table->string('email');
            $table->decimal('debtAmount', 10, 2);
            $table->date('debtDueDate');
            $table->uuid('debtId');
            $table->timestamps();

            $table->index(['historico_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletos');
    }
};
