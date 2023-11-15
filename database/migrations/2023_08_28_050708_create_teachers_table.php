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
        Schema::create('teachers', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('image')->nullable();
			$table->string('user_id')->index();
            $table->string('id_number');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->date('birthdate');
            $table->string('contact_number');
            $table->text('address');
            $table->timestamps();
	        
	        $table->foreign('user_id')
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
        Schema::dropIfExists('teachers');
    }
};
