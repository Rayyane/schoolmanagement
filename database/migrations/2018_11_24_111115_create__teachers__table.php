<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('teacher_name');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->enum('marital_status', ['Married', 'Single']);
            $table->string('spouse_name')->nullable();
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->string('religion');
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('contact_no');
            $table->string('salary');
            $table->string('teacher_photo', 150)->unique();
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
        Schema::dropIfExists('teachers');
    }
}
