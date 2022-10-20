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
        Schema::create('member_appreciations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('appreciation_by');
            $table->unsignedBigInteger('appreciation_to')->nullable();
            $table->longText('comment_data')->nullable();
            $table->dateTime('submitted_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->foreign('appreciation_by')->references('id')->on('users');
            $table->foreign('appreciation_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_appreciations');
    }
};
