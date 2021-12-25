<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectIdFieldToTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {

            if (! Schema::hasColumn('teachers','subject_id')) {
                $table->bigInteger('subject_id')->unsigned()->nullable()->after('name');
                $table->foreign('subject_id')->references('id')->on('subjects');

            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('subject_id');
        });
    }
}
