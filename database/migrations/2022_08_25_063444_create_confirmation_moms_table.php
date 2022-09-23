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
        Schema::create('confirmation_moms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('manager_id');
            $table->text('minutes_of_meeting')->nullable();
            $table->text('hidden_notes')->nullable();
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
        Schema::dropIfExists('confirmation_moms');
    }
};
