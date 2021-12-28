<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClasseIdFieldToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            if (! Schema::hasColumn('students','class_id')) {
                $table->bigInteger('class_id')->unsigned()->nullable()->after('name');
                $table->foreign('class_id')->references('id')->on('classes');

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
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('students_class_id_foreign');
            $table->dropColumn('class_id');
        });
    }
}
