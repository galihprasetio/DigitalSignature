<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_document', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_doc');
            $table->integer('step_number');
            $table->string('author');
            $table->string('status_number');
            $table->string('status');
            $table->string('button');
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
        Schema::dropIfExists('flow_document');
    }
}
