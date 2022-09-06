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
            $table->enum('approachable', ['0','1','2','3','4','5'])->default('0');
            $table->enum('respectful', ['0','1','2','3','4','5'])->default('0');
            $table->enum('explain_job_role', ['0','1','2','3','4','5'])->default('0');
            $table->enum('explain_company_background', ['0','1','2','3','4','5'])->default('0');
            $table->enum('shared_proper_interview_information', ['0','1','2','3','4','5'])->default('0');
            $table->enum('discussed_my_profile', ['0','1','2','3','4','5'])->default('0');
            $table->enum('shared_interview_feedback_quickly', ['0','1','2','3','4','5'])->default('0');
            $table->text('additional_feedback_recruiter');
            $table->enum('rate_overall_conduct', ['0','1','2','3','4','5'])->default('0');
            $table->enum('professionalism', ['0','1','2','3','4','5'])->default('0');
            $table->enum('friendliness', ['0','1','2','3','4','5'])->default('0');
            $table->enum('heplful', ['0','1','2','3','4','5'])->default('0');
            $table->enum('approachable_interviewers', ['0','1','2','3','4','5'])->default('0');
            $table->enum('respectable', ['0','1','2','3','4','5'])->default('0');
            $table->enum('knowledgeable', ['0','1','2','3','4','5'])->default('0');
            $table->enum('clear_communication_about_company', ['0','1','2','3','4','5'])->default('0');
            $table->enum('clear_communication_job_role', ['0','1','2','3','4','5'])->default('0');
            $table->enum('process_started_on_time', ['0','1','2','3','4','5'])->default('0');
            $table->enum('process_fair_apt', ['0','1','2','3','4','5'])->default('0');
            $table->enum('seating_arrangement_comfortable', ['0','1','2','3','4','5'])->default('0');
            $table->enum('staff_helpful_supportive', ['0','1','2','3','4','5'])->default('0');
            $table->enum('received_interview_feedback', ['0','1','2','3','4','5'])->default('0');

            $table->string('define_overall_interview_process')->nullable();

            $table->enum('rate_overall_interview_process', ['0','1','2','3','4','5'])->default('0');

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
