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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('company_location_id')->nullable();
            $table->string('reporting_to_id')->nullable();
            $table->enum('employee_type', ['Probation', 'Confirmed'])->default('Probation');
            $table->date('date_of_confirmation')->nullable();
            $table->date('due_date_of_confirmation')->nullable();
            $table->date('appraisal_cycle')->nullable();
            $table->string('gender')->nullable();
            $table->string('confirmation_ppt')->nullable();
            $table->string('profile_image')->nullable();
            $table->text('confirmation_commitment_details')->nullable();
            $table->foreign('company_id')->references('id')->on('company_names');
            $table->foreign('company_location_id')->references('id')->on('company_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
