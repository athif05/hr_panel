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
        Schema::create('fresh_eye_journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('member_name')->nullable();
            $table->string('member_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('company_name_ajax')->nullable();
            $table->string('company_name_fresh')->nullable();
            $table->string('location_name')->nullable();
            $table->string('tenure_in_month')->nullable();
            $table->string('reporting_manager_name_ajax')->nullable();
            $table->string('reporting_manager_fresh')->nullable();
            $table->string('head_of_department_name_ajax')->nullable();
            $table->string('head_of_department')->nullable();
            $table->text('your_journey_so_far_in_company')->nullable();
            $table->string('top_3_things_like_your_job_1')->nullable();
            $table->string('top_3_things_like_your_job_2')->nullable();
            $table->string('top_3_things_like_your_job_3')->nullable();
            $table->string('three_things_wish_change_job_role_1')->nullable();
            $table->string('three_things_wish_change_job_role_2')->nullable();
            $table->string('three_things_wish_change_job_role_3')->nullable();
            $table->enum('satisfaction_job_role', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('well_equipped_perform_job', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('able_maintain_work_life_balance', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('feel_respected_my_peers', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('suggestions_heard_implemented', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('share_good_bond_superiors', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('know_what_i_expected_to_do', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('i_feel_grow_in_organization', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('any_exemplary_work_achievement_showcase')->nullable();
            $table->text('any_additional_trainings')->nullable();
            $table->text('what_do_you_like_about_company')->nullable();
            $table->text('what_do_you_dislike_about_company')->nullable();
            $table->text('satisfied_employee_benefits_offered_company')->nullable();
            $table->enum('work_culture', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('recruitment_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('induction_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('on_job_training_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clear_communication_changes_policy', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('feeling_belongingness_organization', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('having_best_friend_at_work', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('work_life_balance', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('any_detailed_feedback_support_your_response')->nullable();
            $table->enum('quickness_in_respond_reporting_manager', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('how_well_received_guidance_reporting_manager', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('how_clearly_your_goals_set_reporting_manager', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('how_transparent_is_reporting_manager', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('wprs_happen_every_week_reporting_manager', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('how_well_adjust_changing_priorities_reporting_manager', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('how_comfortable_feel_sharing_feedback_reporting_manager', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('how_well_able_learn_under_guidance_reporting_manager', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('our_organization_believes_mantra')->nullable();
            $table->enum('quickness_in_respond_reporting_manager_qi', ['','1','2','3','4','5'])->default('');
            $table->enum('how_well_received_guidance_reporting_manager_qi', ['','1','2','3','4','5'])->default('');
            $table->enum('how_clearly_your_goals_set_reporting_manager_qi', ['','1','2','3','4','5'])->default('');
            $table->enum('how_transparent_is_reporting_manager_qi', ['','1','2','3','4','5'])->default('');
            $table->enum('frequent_1_1_happen_reporting_manager_qi', ['','1','2','3','4','5'])->default('');
            $table->enum('how_well_adjust_changing_priorities_reporting_manager_qi', ['','1','2','3','4','5'])->default('');
            $table->enum('how_comfortable_feel_sharing_feedback_reporting_manager_qi', ['','1','2','3','4','5'])->default('');
            $table->string('top_3_strengths_reporting_manager_qi_1')->nullable();
            $table->string('top_3_strengths_reporting_manager_qi_2')->nullable();
            $table->string('top_3_strengths_reporting_manager_qi_3')->nullable();
            $table->string('three_areas_improvement_reporting_manager_qi_1')->nullable();
            $table->string('three_areas_improvement_reporting_manager_qi_2')->nullable();
            $table->string('three_areas_improvement_reporting_manager_qi_3')->nullable();
            $table->text('our_organization_believes_mantra_reporting_manager_qi')->nullable();
            $table->enum('quickness_in_respond_hod_qj', ['','1','2','3','4','5'])->default('');
            $table->enum('how_well_received_guidance_hod_qj', ['','1','2','3','4','5'])->default('');
            $table->enum('how_clearly_your_goals_set_hod_qj', ['','1','2','3','4','5'])->default('');
            $table->enum('how_transparent_is_hod_qj', ['','1','2','3','4','5'])->default('');
            $table->enum('frequent_1_1_happen_hod_qj', ['','1','2','3','4','5'])->default('');
            $table->enum('how_well_adjust_changing_priorities_hod_qj', ['','1','2','3','4','5'])->default('');
            $table->enum('how_comfortable_feel_sharing_feedback_hod_qj', ['','1','2','3','4','5'])->default('');
            $table->string('top_3_strengths_hod_qj_1')->nullable();
            $table->string('top_3_strengths_hod_qj_2')->nullable();
            $table->string('top_3_strengths_hod_qj_3')->nullable();
            $table->string('three_areas_improvement_hod_qj_1')->nullable();
            $table->string('three_areas_improvement_hod_qj_2')->nullable();
            $table->string('three_areas_improvement_hod_qj_3')->nullable();
            $table->text('our_organization_believes_mantra_hod_qj')->nullable();
            $table->enum('admin_operations', ['','1','2','3','4','5'])->default('');
            $table->enum('advertiser_sales', ['','1','2','3','4','5'])->default('');
            $table->enum('advertisers', ['','1','2','3','4','5'])->default('');
            $table->enum('finance_accounts', ['','1','2','3','4','5'])->default('');
            $table->enum('human_resources', ['','1','2','3','4','5'])->default('');
            $table->enum('management', ['','1','2','3','4','5'])->default('');
            $table->enum('network_operations', ['','1','2','3','4','5'])->default('');
            $table->enum('pocket_money', ['','1','2','3','4','5'])->default('');
            $table->enum('publishers', ['','1','2','3','4','5'])->default('');
            $table->enum('tech_operations_development', ['','1','2','3','4','5'])->default('');
            $table->enum('support_ea_pa', ['','1','2','3','4','5'])->default('');
            $table->enum('education', ['','1','2','3','4','5'])->default('');
            $table->enum('igaming', ['','1','2','3','4','5'])->default('');
            $table->enum('tech_operations_shopify', ['','1','2','3','4','5'])->default('');
            $table->enum('tech_operations_creative', ['','1','2','3','4','5'])->default('');
            $table->enum('mobile', ['','1','2','3','4','5'])->default('');
            $table->enum('vcommission_uk', ['','1','2','3','4','5'])->default('');
            $table->text('any_additional_feedback_any_department')->nullable();
            $table->text('any_issue_concern_management')->nullable();
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
        Schema::dropIfExists('fresh_eye_journals');
    }
};
