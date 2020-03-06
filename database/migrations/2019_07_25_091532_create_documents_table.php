<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doc_number');
            $table->string('doc_type');
            $table->dateTime('doc_submit_date');
            $table->integer('doc_status_number');
            $table->string('doc_author');
            $table->string('doc_status');
            $table->string('doc_subject');
            $table->integer('id_users');
            $table->text('doc_body');
            $table->string('doc_file');
            
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
        Schema::dropIfExists('documents');
    }
}
