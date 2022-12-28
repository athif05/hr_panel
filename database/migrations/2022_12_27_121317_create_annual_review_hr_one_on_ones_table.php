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
        Schema::create('annual_review_hr_one_on_ones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('filled_by');
            $table->unsignedBigInteger('filled_for');
            $table->unsignedBigInteger('annual_review_form_id');
            $table->string('put_ever_pip')->nullable();
            $table->date('pip_start_date')->nullable();
            $table->date('pip_end_date')->nullable();
            $table->string('member_appraisal_cycle')->nullable();
            $table->string('hr_id_taking_this_1_1')->nullable();
            $table->string('Which_level_place_yourself')->nullable();
            $table->string('current_monthly_salary')->nullable();
            $table->string('current_annual_salary')->nullable();
            $table->string('total_expected_increment_monthly_salary')->nullable();
            $table->string('total_expected_increment_monthly_salary_percentage')->nullable();
            $table->string('hr_notes')->nullable();
            $table->string('promotion_in_designation')->nullable();
            $table->string('designation_id_promotion')->nullable();
            $table->longText('share_your_accomplishments')->nullable();
            $table->longText('share_issues_challenges_impact_work')->nullable();
            $table->longText('openly_share_issues_need_closures')->nullable();
            $table->longText('see_yourself_moving_ahead_next_year')->nullable();
            $table->longText('any_additional_feedback_wish_to_share')->nullable();
            $table->string('fy')->nullable();
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1','2'])->default('0');
            $table->timestamps();
            $table->foreign('filled_by')->references('id')->on('users');
            $table->foreign('filled_for')->references('id')->on('users');
            $table->foreign('annual_review_form_id')->references('id')->on('annual_review_forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annual_review_hr_one_on_ones');
    }
};
