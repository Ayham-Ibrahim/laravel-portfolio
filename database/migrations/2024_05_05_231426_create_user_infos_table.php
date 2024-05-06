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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->date('birth_date');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('website');
            $table->string('job_title');
            $table->string('first_image');
            $table->string('second_image');
            $table->string('cv');
            $table->softDeletes();
            $table->timestamps();
        });
    }
// 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
