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
            $table->string('minutes_of_meeting')->nullable();
            $table->string('hidden_notes')->nullable();
            $table->enum('content', ['0','1','2','3','4','5'])->default('0');
            $table->enum('confidence', ['0','1','2','3','4','5'])->default('0');
            $table->enum('communication', ['0','1','2','3','4','5'])->default('0');
            $table->enum('data_relevance', ['0','1','2','3','4','5'])->default('0');
            $table->enum('overall_growth_individual', ['0','1','2','3','4','5'])->default('0');
            $table->string('average_rating_entire_presentation')->nullable();
            $table->string('recommend_increment')->nullable();
            $table->string('how_much_increment')->nullable();
            $table->string('how_much_increment_amount')->nullable();
            $table->string('are_you_sure_to_confirm')->nullable();
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
