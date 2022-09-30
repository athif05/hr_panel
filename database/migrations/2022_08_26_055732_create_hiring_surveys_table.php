<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hiring_surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('manager_id');
            $table->string('member_name');
            $table->string('designation');
            $table->string('department');
            $table->string('location');
            $table->string('company_name');
            $table->string('recruiter_name');
            $table->string('location_name_position_open');
            $table->string('designation_name_open_position');
            $table->string('no_of_openings');
            $table->enum('all_posoitions_closed', ['','Yes','No'])->default('');
            $table->enum('recruiter_helpful_recruitment_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('recruiter_response', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('recruiter_understanding_job_requirement', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('quality_of_candidates_presented', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('number_of_candidates_presented', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('rate_the_recruiter_correct_information', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('assessment_screening_candidates', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('time_taken_fill_open_position', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('overall_satisfied_hiring_recruiting_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_recruiter');
            $table->text('any_suggestions_improve_hiring_process');
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1','2'])->default('0');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hiring_surveys');
    }
};
