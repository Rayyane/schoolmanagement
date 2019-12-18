<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLevelEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('level_enrolls', function (Blueprint $table) {
            $table->dropForeign('level_enrolls_level_id_foreign');
            $table->dropForeign('level_enrolls_session_id_foreign');
            $table->dropForeign('level_enrolls_branch_id_foreign');
            $table->dropForeign('level_enrolls_shift_id_foreign');

            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('level_enrolls', function (Blueprint $table) {
            
            
        });
    }
}
