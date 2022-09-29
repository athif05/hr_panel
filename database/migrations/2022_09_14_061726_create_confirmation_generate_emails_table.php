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
        Schema::create('confirmation_generate_emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('updated_by_id');
            $table->string('member_name')->nullable();
            $table->string('letter_type')->nullable();
            $table->string('increment_amount')->nullable();
            $table->string('promotion')->nullable();
            $table->string('appraisal_cycle')->nullable();
            $table->date('appraisal_effect_date')->nullable();
            $table->date('pip_month')->nullable();
            $table->date('final_confirmation_date')->nullable();
            $table->date('revised_appraisl_cycle')->nullable();
            $table->date('session_date')->nullable();
            $table->time('session_time')->nullable();
            $table->string('poc_name')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1','2'])->default('0');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('confirmation_generate_emails');
    }
};
