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
        Schema::create('days_45_checkin_managers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('manager_id');
            $table->enum('departmental_processes', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('tod_eod_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('month_summary_process', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('relevant_software_tools', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('organization_policies_processes', ['NA','1','2','3','4','5'])->default('NA');
            $table->string('which_category_like_place')->nullable();
            $table->string('integrity')->nullable();
            $table->string('win_win')->nullable();
            $table->string('synergise')->nullable();
            $table->string('closure')->nullable();
            $table->string('knowledge')->nullable();
            $table->string('kiss')->nullable();
            $table->string('innovation')->nullable();
            $table->string('celebration')->nullable();
            $table->longText('major_achievements')->nullable();
            $table->longText('major_fallbacks')->nullable();
            $table->longText('recommend_to_change_approach')->nullable();
            $table->enum('adding_value_your_team_expectations', ['','Yes','No'])->default('');
            $table->longText('justify_above_answer')->nullable();
            $table->longText('long_term_goal')->nullable();
            $table->longText('any_additional_feedback')->nullable();
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1','2'])->default('0');
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('users');
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
        Schema::dropIfExists('days_45_checkin_managers');
    }
};
