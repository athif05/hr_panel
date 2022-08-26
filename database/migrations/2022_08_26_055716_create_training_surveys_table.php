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
        Schema::create('training_surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('member_name');
            $table->string('member_id');
            $table->string('designation');
            $table->string('department');
            $table->string('email');
            $table->string('company_name');
            $table->string('location_name');
            $table->string('trainer_1_name');
            $table->enum('expertise_on_subject_matter_1', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clear_effective_communication_skills_1', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('effective_delivery_content_1', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('timely_response_queries_1', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('comfortability_sharing_concerns_doubts_1', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_trainer_1');
            $table->string('trainer_2_name');
            $table->enum('expertise_on_subject_matter_2', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clear_effective_communication_skills_2', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('effective_delivery_content_2', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('timely_response_queries_2', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('comfortability_sharing_concerns_doubts_2', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_trainer_2');
            $table->string('trainer_3_name');
            $table->enum('expertise_on_subject_matter_3', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clear_effective_communication_skills_3', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('effective_delivery_content_3', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('timely_response_queries_3', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('comfortability_sharing_concerns_doubts_3', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_trainer_3');
            $table->string('trainer_4_name');
            $table->enum('expertise_on_subject_matter_4', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clear_effective_communication_skills_4', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('effective_delivery_content_4', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('timely_response_queries_4', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('comfortability_sharing_concerns_doubts_4', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_trainer_4');
            $table->string('trainer_5_name');
            $table->enum('expertise_on_subject_matter_5', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clear_effective_communication_skills_5', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('effective_delivery_content_5', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('timely_response_queries_5', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('comfortability_sharing_concerns_doubts_5', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('additional_feedback_trainer_5');
            $table->enum('training_first_week_joining', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('training_sessions_went_as_planned', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('training_topics_were_covered_in_detail', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('training_was_effective_helping', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('clearly_understood_all_modules', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('self_study_material_useful', ['NA','1','2','3','4','5'])->default('NA');
            $table->text('is_there_any_topic');
            $table->text('interesting_part_elaborate');
            $table->text('any_suggestions_feedback');
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
        Schema::dropIfExists('training_surveys');
    }
};
