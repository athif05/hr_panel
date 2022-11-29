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
        Schema::create('section_fy_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('annual_review_form_id')->nullable();
            $table->string('section_name')->nullable();
            $table->text('section_description')->nullable();
            $table->string('visible_for')->nullable();            
            $table->enum('status', ['0','1','2'])->default('0');
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
        Schema::dropIfExists('section_fy_lists');
    }
};
