<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAssignedUserIdFeesBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fees_books', function (Blueprint $table) {
            $table->renameColumn('assigned_user_id', 'teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fees_books', function (Blueprint $table) {
            $table->renameColumn('teacher_id', 'assigned_user_id');
        });
    }
}
