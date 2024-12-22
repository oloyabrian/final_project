<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPersonsIdFromBaptismsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('baptisms', function (Blueprint $table) {
            $table->dropColumn('persons_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('baptisms', function (Blueprint $table) {
            $table->unsignedBigInteger('persons_id'); // Recreate the column if rolling back
        });
    }
}
