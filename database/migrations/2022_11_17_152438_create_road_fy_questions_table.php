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
            $table->unsignedBigInteger('road_fy_id');
            $table->string('question_title');
            $table->string('question_type');
            $table->text('question_value');
            $table->enum('status', ['0','1'])->default('0');
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->foreign('road_fy_id')->references('id')->on('road_fys');
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
