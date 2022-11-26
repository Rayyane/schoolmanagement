<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectedFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collected_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('collector_id')->unsigned();
            $table->integer('section_student_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->string('fees_book_leaf_number');
            $table->date('collection_date');
            $table->decimal('total_collected', 8, 2);
            $table->decimal('total_advanced', 8, 2);
            $table->decimal('total_due', 8, 2);
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('section_student_id')->references('id')->on('section_students')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('collected_fees');
    }
}
