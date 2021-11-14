<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // mix of grade, number, option, branch
            $table->integer('number')->unsigned()->nullable();
            $table->bigInteger('grade_id')->unsigned()->nullable();
            $table->bigInteger('option_id')->unsigned()->nullable();
            $table->bigInteger('branch_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branchs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
