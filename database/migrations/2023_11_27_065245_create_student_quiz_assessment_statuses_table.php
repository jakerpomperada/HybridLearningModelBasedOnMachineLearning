<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_quiz_assessment_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sqac_id')->index();
            $table->uuid('student_id')->index();
            $table->timestamps();



            $table->foreign('sqac_id')
                ->references('id')
                ->on('student_quiz_assessment_categories')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_quiz_assessment_statuses');
    }
};
