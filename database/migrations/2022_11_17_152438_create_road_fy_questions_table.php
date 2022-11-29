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
        Schema::create('road_fy_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('annual_review_form_id');
            $table->string('section_name');
            $table->text('question_title');
            $table->text('question_hint');
            $table->string('question_type');
            $table->text('question_value')->nullable();
            $table->enum('status', ['0','1'])->default('0');
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
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
        Schema::dropIfExists('road_fy_questions');
    }
};
