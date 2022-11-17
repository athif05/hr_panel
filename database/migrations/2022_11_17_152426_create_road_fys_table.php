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
        Schema::create('road_fys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('appraisal_cycle');
            $table->integer('no_of_section');
            $table->unsignedBigInteger('role_id');
            $table->enum('status', ['0','1'])->default('0');
            $table->enum('is_deleted', ['0', '1'])->default('0');
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('road_fys');
    }
};
