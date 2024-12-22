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
        Schema::create('marriages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')
            ->references('id')->on('persons')
            ->onDelete('cascade');
            $table->string('spouse');
            $table->string('marriage_date');
            $table->string('matron');
            $table->string('patron');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marriages');
    }
};
