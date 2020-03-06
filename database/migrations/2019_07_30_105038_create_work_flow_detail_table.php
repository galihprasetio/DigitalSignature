<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkFlowDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_flow_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_work_flow');
            $table->integer('step_number');
            $table->string('status');
            $table->string('author');
            $table->boolean('sentBack');
            $table->boolean('check');
            $table->boolean('approve');
            $table->boolean('reject');
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
        Schema::dropIfExists('work_flow_detail');
    }
}
