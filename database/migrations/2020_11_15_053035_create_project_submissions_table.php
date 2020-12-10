<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group_id');
            $table->string('project_folder');
            $table->string('github_link');
            $table->string('final_report');
            $table->integer('report_marks');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('project_submissions');
    }
}
