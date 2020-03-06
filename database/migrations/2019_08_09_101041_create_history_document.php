<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryDocument extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_document', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_document');
            $table->integer('id_user');
            $table->string('activity');
            $table->string('commentar');
            $table->dateTime('activity_date');
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
        Schema::dropIfExists('history_document');
    }
}
