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
        Schema::create('academic_term_semesters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('academic_id')->index();
            $table->char('semester', 3)->default('1st');
            $table->timestamps();

            $table->foreign('academic_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_term_semesters');
    }
};
