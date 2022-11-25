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
        Schema::create('annual_review_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('form_name');
            $table->string('appraisal_month');
            $table->string('appraisal_year');
            $table->string('survey_form_label')->nullable();
            $table->string('hr_1_1_label')->nullable();
            $table->string('ppt_label')->nullable();
            $table->string('stakeholder_label')->nullable();
            $table->enum('status', ['0','1'])->default('0');
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annual_review_forms');
    }
};
