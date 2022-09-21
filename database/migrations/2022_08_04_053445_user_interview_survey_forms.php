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
        Schema::create('user_interview_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('member_name');
            $table->string('official_email');
            $table->string('company_name');
            $table->string('job_position_name');
            $table->string('location_name')->nullable();
            $table->string('learn_about_job_opening')->nullable();
            $table->string('referral_source_name')->nullable();
            $table->string('company_hr_name')->nullable();
            $table->string('hr_name_ajax')->nullable();
            $table->enum('prompt_responding_my_queries', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('approachable', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('respectful', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('explain_job_role', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('explain_company_background', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('shared_proper_interview_information', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('discussed_my_profile', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('shared_interview_feedback_quickly', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_recruiter');
            $table->enum('rate_overall_conduct', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('professionalism', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('friendliness', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('heplful', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('approachable_interviewers', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('respectable', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('knowledgeable', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clear_communication_about_company', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clear_communication_job_role', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('process_started_on_time', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('process_fair_apt', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('seating_arrangement_comfortable', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('staff_helpful_supportive', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('received_interview_feedback', ['NA','1','2','3','4','5'])->default('NA');
            $table->string('define_overall_interview_process')->nullable();
            $table->text('define_overall_interview_process_others')->nullable();
            $table->enum('rate_overall_interview_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('comments_suggestions_feedback')->nullable();
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1','2'])->default('0');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_interview_forms');
    }
};
