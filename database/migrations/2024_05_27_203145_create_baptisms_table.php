<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaptismsTable extends Migration
{
    public function up()
{
    Schema::create('baptisms', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('person_id'); // Correct column name
        $table->date('bdate');
        $table->string('place');
        $table->string('sponsor');
        $table->string('minister');
        $table->timestamps();
        
        // Foreign key constraint if persons table exists
        $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('baptisms');
}

}
