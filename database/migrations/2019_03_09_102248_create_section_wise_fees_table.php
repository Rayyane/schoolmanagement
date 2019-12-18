<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionWiseFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_wise_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('fees_type_id')->unsigned();
            $table->integer('business_month_id')->unsigned();
            $table->decimal('amount', 8, 2);
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('fees_type_id')->references('id')->on('fees_types')->onDelete('cascade');
            $table->foreign('business_month_id')->references('id')->on('business_months')->onDelete('cascade');
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
        Schema::dropIfExists('section_wise_fees');
    }
}
