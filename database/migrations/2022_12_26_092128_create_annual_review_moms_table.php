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
        Schema::create('annual_review_moms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('filled_by');
            $table->unsignedBigInteger('filled_for');
            $table->unsignedBigInteger('annual_review_form_id');
            $table->longText('minutes_of_meeting')->nullable();
            $table->longText('hidden_notes')->nullable();
            $table->enum('content', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('confidence', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('communication', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('data_relevance', ['NA','1','2','3','4','5'])->default('NA');
            $table->enum('overall_growth_individual', ['NA','1','2','3','4','5'])->default('NA');
            $table->string('average_rating_entire_presentation')->nullable();
            $table->string('recommend_increment')->nullable();
            $table->string('how_much_increment')->nullable();
            $table->string('how_much_increment_amount')->nullable();
            $table->string('how_much_increment_percentage')->nullable();
            $table->string('recommend_for_promotion')->nullable();
            $table->string('recommend_for_promotion_id')->nullable();
            $table->string('are_you_sure_to_confirm')->nullable();
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
        Schema::dropIfExists('annual_review_moms');
    }
};
