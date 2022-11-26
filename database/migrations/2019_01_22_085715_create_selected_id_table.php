<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectedIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_ids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_subject_result_id')->unsigned();
            $table->integer('term_result_id')->unsigned();
            $table->foreign('student_subject_result_id')->references('id')->on('student_subject_results');
            $table->foreign('term_result_id')->references('id')->on('term_results');
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
        Schema::dropIfExists('selected_ids');
    }
}
