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
        Schema::create('user_recruitment_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('your_name');
            $table->string('member_id');
            $table->string('designation');
            $table->string('department');
            $table->string('company_name');
            $table->date('date_of_joining')->nullable();
            $table->string('how_come_for_job_opening');
            $table->string('internal_employee_name')->nullable();
            $table->string('internal_employee_designation')->nullable();
            $table->string('internal_employee_department')->nullable();
            $table->string('name_of_your_recruiter');
            $table->enum('professionalism', ['0','1','2','3','4','5'])->default('0');
            $table->enum('friendliness', ['0','1','2','3','4','5'])->default('0');
            $table->enum('length_time_spent_talking', ['0','1','2','3','4','5'])->default('0');
            $table->enum('company_knowledge', ['0','1','2','3','4','5'])->default('0');
            $table->enum('specific_knowledge_job_profile', ['0','1','2','3','4','5'])->default('0');
            $table->enum('timely_response_email_phone', ['0','1','2','3','4','5'])->default('0');
            $table->enum('company_policies_procedures', ['','Yes','No'])->default('');
            $table->enum('manager_expectation_setting', ['','Yes','No'])->default('');
            $table->enum('job_duties_responsibilities', ['','Yes','No'])->default('');
            $table->enum('job_title_properly_named', ['','Yes','No'])->default('');
            $table->text('mission_for_first_year');
            $table->text('aim_in_second_year');
            $table->text('aim_third_year_tenure');
            $table->enum('rate_overall_recruitment_process', ['0','1','2','3','4','5'])->default('0');
            $table->text('additional_feedback_recruitment_process');
            $table->enum('rate_hr_induction', ['0','1','2','3','4','5'])->default('0');
            $table->text('additional_feedback_hr_induction');
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
        Schema::dropIfExists('user_recruitment_forms');
    }
};
