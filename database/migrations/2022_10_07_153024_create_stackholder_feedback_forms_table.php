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
        Schema::create('stackholder_feedback_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('manager_id');
            $table->enum('quality_of_the_work', ['','1','2','3','4','5'])->default('');
            $table->enum('tat_adherence', ['','1','2','3','4','5'])->default('');
            $table->enum('ability_to_understand_project_requirements', ['','1','2','3','4','5'])->default('');
            $table->enum('ability_to_absorb_feedback', ['','1','2','3','4','5'])->default('');
            $table->enum('responsiveness_on_all_platforms', ['','1','2','3','4','5'])->default('');
            $table->enum('how_happy_you_with_performance', ['','1','2','3','4','5'])->default('');
            $table->string('three_qualities_1')->nullable();
            $table->string('three_qualities_2')->nullable();
            $table->string('three_qualities_3')->nullable();
            $table->string('three_areas_of_improvement_1')->nullable();
            $table->string('three_areas_of_improvement_2')->nullable();
            $table->string('three_areas_of_improvement_3')->nullable();
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
        Schema::dropIfExists('stackholder_feedback_forms');
    }
};
