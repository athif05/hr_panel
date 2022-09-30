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
        Schema::create('initiating_pip_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('updated_by_id');
            $table->string('member_name')->nullable();
            $table->date('date_initiating_pip')->nullable();
            $table->string('no_of_days')->nullable();
            $table->string('day')->nullable();
            $table->date('closing_date_pip')->nullable();
            $table->text('issue_description_performance_behaviour');
            $table->text('description_expected_performance');
            $table->text('plan_of_action_to_improve');
            $table->text('final_pip_review');
            $table->text('seen_considerable_improvemnet_performance');
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->enum('status', ['0', '1','2'])->default('0');
            $table->enum('closure_status', ['0', '1','2'])->default('0');
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
        Schema::dropIfExists('initiating_pip_forms');
    }
};
