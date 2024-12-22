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
        Schema::create('communions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')
            ->references('id')->on('persons')
            ->onDelete('cascade');
            $table->date('cdate');
            $table->string('cplace');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communions');
    }
};
