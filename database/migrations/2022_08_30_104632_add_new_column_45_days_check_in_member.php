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
        Schema::table('days_45_checkin_members', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('member_name')->nullable();
            $table->string('member_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('official_email')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location_name')->nullable();
            $table->string('reporting_manager')->nullable();
            $table->string('reporting_manager_name')->nullable();
            $table->string('head_of_department')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('hr_name_taking_session')->nullable();
            $table->string('place_yourself_category')->nullable();
            $table->enum('target', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('response', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('jd', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('reliability', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('team_spirit', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('attendance', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('attitude', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('rules', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('peers', ['','NA','1','2','3','4','5'])->default('');
            $table->string('integrity')->nullable();
            $table->string('win_win')->nullable();
            $table->string('synergize')->nullable();
            $table->string('closure')->nullable();
            $table->string('knowledge')->nullable();
            $table->string('kiss')->nullable();
            $table->string('innovation')->nullable();
            $table->string('celebration')->nullable();
            $table->enum('company_work_culture', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('processes_policies_well_defined', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('enjoy_work_life_balance', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('happy_with_treated_in_company', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('job_title_kras', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('necessary_resources_available', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('feel_grow_in_organization', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('complete_clarity_my_role', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('overall_happy_with_job_role', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('training_elaborative_well_explained', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('training_duration_apt', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('proper_modules_defined_topic', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('adequate_supporting_material', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('clarity_on_topics_during_training', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('great_relationship_with_manager', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('reviewed_properly_feedback_shared_timely', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('openly_share_opinions', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('receive_adequate_guidance', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('receive_adequate_timely_feedback', ['','NA','1','2','3','4','5'])->default('');
            $table->enum('get_quick_resolution_issue', ['','NA','1','2','3','4','5'])->default('');
            $table->string('frequently_receive_feedback_manager')->nullable();
            $table->text('any_additional_feedback_manager')->nullable();
            $table->enum('receive_proper_job_kra', ['','NA','Yes','No'])->default('');
            $table->enum('proper_training_plan', ['','NA','Yes','No'])->default('');
            $table->enum('training_executed_planned', ['','NA','Yes','No'])->default('');
            $table->enum('marked_regularly_your_eod', ['','NA','Yes','No'])->default('');
            $table->enum('wpr_happen_atleast_once_week', ['','NA','Yes','No'])->default('');
            $table->enum('one_to_one_interaction', ['','NA','Yes','No'])->default('');
            $table->text('best_experience_tenure')->nullable();
            $table->text('like_most_working')->nullable();
            $table->text('like_to_change_add')->nullable();
            $table->text('who_inspired_you_organization')->nullable();
            $table->text('mention_achievement')->nullable();
            $table->text('facing_any_challenges')->nullable();
            $table->text('need_additional_training')->nullable();
            $table->text('any_additional_feedback_share')->nullable();
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
        Schema::table('days_45_checkin_members', function (Blueprint $table) {
            //
        });
    }
};
