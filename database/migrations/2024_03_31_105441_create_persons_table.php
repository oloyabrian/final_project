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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('cname');
            $table->string('sname');
            $table->string('oname')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->string('fname');
            $table->string('mname');
            $table->string('village');
            $table->string('tel')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
