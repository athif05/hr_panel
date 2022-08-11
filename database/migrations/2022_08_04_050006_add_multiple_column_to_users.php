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
            $table->date('joining_date')->nullable();
            $table->string('manager_name');
            $table->string('manager_email');
            $table->enum('status', ['0', '1'])->default('0');
            $table->enum('is_deleted', ['0', '1'])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['joining_date',  'manager_name', 'manager_email', 'two_days_interview_forms_status', 'two_days_recruitment_forms_status', 'checkin_form_member_status', 'checkin_form_manager_status', 'confirmation_initaition_email_member_status', 'fresh_eye_journal_form_status','confirmation_feedback_form_status']);
        });
    }
};
