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
            $table->string('how_come_for_job_opening')->nullable();
            $table->string('internal_employee_name')->nullable();
            $table->string('internal_employee_designation')->nullable();
            $table->string('internal_employee_department')->nullable();
            $table->string('name_of_your_recruiter')->nullable();
            $table->enum('professionalism', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('friendliness', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('length_time_spent_talking', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('company_knowledge', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('specific_knowledge_job_profile', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('timely_response_email_phone', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('company_policies_procedures', ['','Yes','No'])->default('');
            $table->enum('manager_expectation_setting', ['','Yes','No'])->default('');
            $table->enum('job_duties_responsibilities', ['','Yes','No'])->default('');
            $table->enum('job_title_properly_named', ['','Yes','No'])->default('');
            $table->text('mission_for_first_year')->nullable();
            $table->text('aim_in_second_year')->nullable();
            $table->text('aim_third_year_tenure')->nullable();
            $table->enum('rate_overall_recruitment_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_recruitment_process')->nullable();
            $table->enum('rate_hr_induction', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_hr_induction')->nullable();
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
