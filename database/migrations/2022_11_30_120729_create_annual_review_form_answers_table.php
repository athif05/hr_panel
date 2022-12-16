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
        Schema::create('annual_review_form_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('annual_review_form_id');
            $table->string('section_id')->nullable();
            $table->string('section_name')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->string('question_type')->nullable();
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('users');
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
        Schema::dropIfExists('annual_review_form_answers');
    }
};
