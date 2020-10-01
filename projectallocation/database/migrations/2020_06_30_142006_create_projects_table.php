<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->unsignedInteger('lecturer_id');
            $table->string('description');
            $table->integer('capacity');
            //$table->string('lecturer');
            //$table->string('choices');
            //$table->unsignedInteger('student_id')->nullable();
            $table->timestamps();

            $table->foreign('lecturer_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            //$table->foreign('student_id')->references('id')->on('users')
                //->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
