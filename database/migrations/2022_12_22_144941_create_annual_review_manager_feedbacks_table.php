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
        Schema::create('annual_review_manager_feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('manager_id');
            $table->enum('discipline', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('punctuality', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('work_ethics', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('team_work', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('response_towards_feedback', ['NA','1','2','3','4','5'])->default('NA');
            $table->longText('elaborate_performance')->nullable();
            $table->string('top_3_highlights_1')->nullable();
            $table->string('top_3_highlights_2')->nullable();
            $table->string('top_3_highlights_3')->nullable();
            $table->string('major_task_1')->nullable();
            $table->string('major_task_2')->nullable();
            $table->string('major_task_3')->nullable();
            $table->enum('add_value_in_team', ['Yes','No'])->default('Yes');
            $table->longText('add_value_in_team_share_instance')->nullable();
            $table->string('areas_of_improvement_1')->nullable();
            $table->string('areas_of_improvement_2')->nullable();
            $table->string('areas_of_improvement_3')->nullable();
            $table->enum('met_your_expectations', ['Yes','No'])->default('Yes');
            $table->longText('met_your_expectations_other_specify')->nullable();
            $table->string('are_you_sure_to_confirm')->nullable();
            $table->string('recommend_pip_detailed_plan')->nullable();
            $table->enum('increment_on_confirmation', ['Yes','No'])->default('Yes');
            $table->string('mention_the_amount')->nullable();
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
        Schema::dropIfExists('annual_review_manager_feedbacks');
    }
};
