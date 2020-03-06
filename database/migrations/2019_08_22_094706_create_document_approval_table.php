<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_approval', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_document');
            $table->integer('id_user');
            $table->string('status');
            $table->dateTime('date_action');
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
        Schema::dropIfExists('document_approval');
    }
}
